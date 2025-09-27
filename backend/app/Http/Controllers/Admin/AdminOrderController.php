<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\OrderStatusUpdated;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AdminOrderController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->middleware(['auth', 'admin']);
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems.product', 'payments'])
            ->orderBy('created_at', 'desc');

        // Filtros
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_method')) {
            $query->whereHas('payments', function ($q) use ($request) {
                $q->where('payment_method', $request->payment_method);
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('min_amount')) {
            $query->where('total_amount', '>=', $request->min_amount);
        }

        if ($request->filled('max_amount')) {
            $query->where('total_amount', '<=', $request->max_amount);
        }

        $orders = $query->paginate(20)->appends($request->query());

        // Estadísticas para la vista
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending_payment')->count(),
            'confirmed_orders' => Order::where('status', 'confirmed')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'shipped_orders' => Order::where('status', 'shipped')->count(),
            'delivered_orders' => Order::where('status', 'delivered')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])
                                   ->sum('total_amount'),
            'pending_payments' => Payment::where('status', 'pending')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product', 'payments']);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending_payment,confirmed,processing,shipped,delivered,cancelled',
            'status_notes' => 'nullable|string|max:500',
            'tracking_number' => 'nullable|string|max:100',
        ]);

        $previousStatus = $order->status;
        $order->status = $request->status;
        
        if ($request->filled('status_notes')) {
            $order->status_notes = $request->status_notes;
        }

        if ($request->filled('tracking_number')) {
            $order->tracking_number = $request->tracking_number;
        }

        // Establecer fechas específicas según el estado
        switch ($request->status) {
            case 'confirmed':
                if (!$order->confirmed_at) {
                    $order->confirmed_at = now();
                }
                break;
            case 'processing':
                if (!$order->processing_at) {
                    $order->processing_at = now();
                }
                break;
            case 'shipped':
                if (!$order->shipped_at) {
                    $order->shipped_at = now();
                }
                break;
            case 'delivered':
                if (!$order->delivered_at) {
                    $order->delivered_at = now();
                }
                break;
            case 'cancelled':
                if (!$order->cancelled_at) {
                    $order->cancelled_at = now();
                }
                // Restaurar stock si se cancela
                foreach ($order->orderItems as $item) {
                    if ($item->product && in_array($previousStatus, ['confirmed', 'processing'])) {
                        $item->product->increment('stock', $item->quantity);
                    }
                }
                break;
        }

        $order->save();

        // Notificar al cliente
        $order->user->notify(new OrderStatusUpdated($order, $previousStatus, $request->status_notes));

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Estado del pedido actualizado exitosamente.');
    }

    /**
     * Verify a QR payment.
     */
    public function verifyPayment(Request $request, Payment $payment)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'admin_notes' => 'nullable|string|max:500'
        ]);

        try {
            if ($request->action === 'approve') {
                $result = $this->paymentService->verifyQrPayment($payment->id, true, $request->admin_notes);
                $message = 'Pago aprobado exitosamente.';
            } else {
                $result = $this->paymentService->verifyQrPayment($payment->id, false, $request->admin_notes);
                $message = 'Pago rechazado.';
            }

            if ($result['success']) {
                return redirect()->route('admin.orders.show', $payment->order)
                    ->with('success', $message);
            } else {
                return redirect()->route('admin.orders.show', $payment->order)
                    ->with('error', $result['message']);
            }
        } catch (\Exception $e) {
            Log::error('Error verifying payment: ' . $e->getMessage());
            return redirect()->route('admin.orders.show', $payment->order)
                ->with('error', 'Error al procesar la verificación del pago.');
        }
    }

    /**
     * Process a refund.
     */
    public function processRefund(Request $request, Payment $payment)
    {
        $request->validate([
            'refund_amount' => 'required|numeric|min:0.01|max:' . $payment->amount,
            'refund_reason' => 'required|string|max:500'
        ]);

        try {
            $result = $this->paymentService->processRefund(
                $payment->id,
                $request->refund_amount,
                $request->refund_reason
            );

            if ($result['success']) {
                return redirect()->route('admin.orders.show', $payment->order)
                    ->with('success', 'Reembolso procesado exitosamente.');
            } else {
                return redirect()->route('admin.orders.show', $payment->order)
                    ->with('error', $result['message']);
            }
        } catch (\Exception $e) {
            Log::error('Error processing refund: ' . $e->getMessage());
            return redirect()->route('admin.orders.show', $payment->order)
                ->with('error', 'Error al procesar el reembolso.');
        }
    }

    /**
     * Bulk actions for orders.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:update_status,export,delete',
            'order_ids' => 'required|array|min:1',
            'order_ids.*' => 'exists:orders,id',
            'bulk_status' => 'required_if:action,update_status|in:pending_payment,confirmed,processing,shipped,delivered,cancelled',
            'bulk_notes' => 'nullable|string|max:500'
        ]);

        $orders = Order::whereIn('id', $request->order_ids)->get();

        switch ($request->action) {
            case 'update_status':
                $updated = 0;
                foreach ($orders as $order) {
                    if ($order->status !== $request->bulk_status) {
                        $previousStatus = $order->status;
                        $order->status = $request->bulk_status;
                        $order->status_notes = $request->bulk_notes;
                        $order->save();

                        // Notificar al cliente
                        $order->user->notify(new OrderStatusUpdated($order, $previousStatus, $request->bulk_notes));
                        $updated++;
                    }
                }
                return redirect()->route('admin.orders.index')
                    ->with('success', "Se actualizaron {$updated} pedidos exitosamente.");

            case 'export':
                return $this->exportOrders($orders);

            case 'delete':
                // Solo permitir eliminar pedidos cancelados
                $deletable = $orders->where('status', 'cancelled');
                $deleted = $deletable->count();
                
                foreach ($deletable as $order) {
                    $order->delete();
                }
                
                return redirect()->route('admin.orders.index')
                    ->with('success', "Se eliminaron {$deleted} pedidos cancelados.");
        }
    }

    /**
     * Export orders to CSV.
     */
    public function export(Request $request)
    {
        $query = Order::with(['user', 'orderItems.product', 'payments']);

        // Aplicar los mismos filtros que en index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        return $this->exportOrders($orders);
    }

    /**
     * Generate CSV export for orders.
     */
    private function exportOrders($orders)
    {
        $filename = 'pedidos_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Headers CSV
            fputcsv($file, [
                'Número de Pedido',
                'Cliente',
                'Email',
                'Estado',
                'Método de Pago',
                'Total',
                'Fecha de Pedido',
                'Dirección de Entrega',
                'Teléfono',
                'Productos',
                'Estado de Pago'
            ]);

            foreach ($orders as $order) {
                $products = $order->orderItems->map(function($item) {
                    return $item->product_name . ' (x' . $item->quantity . ')';
                })->implode('; ');

                $paymentStatus = $order->payments->count() > 0 
                    ? $order->payments->first()->status 
                    : 'Sin pago';

                $paymentMethod = $order->payments->count() > 0 
                    ? $order->payments->first()->payment_method 
                    : 'N/A';

                fputcsv($file, [
                    $order->order_number,
                    $order->user->name,
                    $order->user->email,
                    $order->status,
                    $paymentMethod,
                    $order->total_amount,
                    $order->created_at->format('Y-m-d H:i:s'),
                    $order->delivery_address_line1 . ', ' . $order->delivery_city,
                    $order->delivery_phone,
                    $products,
                    $paymentStatus
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get dashboard statistics.
     */
    public function dashboard()
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();

        $stats = [
            // Pedidos por estado
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending_payment')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'shipped_orders' => Order::where('status', 'shipped')->count(),
            'delivered_orders' => Order::where('status', 'delivered')->count(),

            // Ingresos
            'total_revenue' => Order::whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])
                                   ->sum('total_amount'),
            'today_revenue' => Order::whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])
                                   ->whereDate('created_at', $today)
                                   ->sum('total_amount'),
            'week_revenue' => Order::whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])
                                  ->where('created_at', '>=', $thisWeek)
                                  ->sum('total_amount'),
            'month_revenue' => Order::whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])
                                   ->where('created_at', '>=', $thisMonth)
                                   ->sum('total_amount'),

            // Pedidos por período
            'today_orders' => Order::whereDate('created_at', $today)->count(),
            'week_orders' => Order::where('created_at', '>=', $thisWeek)->count(),
            'month_orders' => Order::where('created_at', '>=', $thisMonth)->count(),

            // Pagos pendientes
            'pending_payments' => Payment::where('status', 'pending')->count(),
            'failed_payments' => Payment::where('status', 'failed')->count(),

            // Promedio
            'average_order_value' => Order::whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])
                                         ->avg('total_amount') ?? 0,
        ];

        // Datos para gráficos
        $dailyOrders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(total_amount) as revenue')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        $topProducts = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->selectRaw('product_name, SUM(quantity) as total_sold, SUM(total_price) as total_revenue')
            ->whereIn('orders.status', ['confirmed', 'processing', 'shipped', 'delivered'])
            ->groupBy('product_name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        $recentOrders = Order::with(['user', 'payments'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.orders.dashboard', compact(
            'stats', 
            'dailyOrders', 
            'ordersByStatus', 
            'topProducts', 
            'recentOrders'
        ));
    }

    /**
     * Show order notes and history.
     */
    public function notes(Order $order)
    {
        $order->load(['user', 'payments']);
        
        // Crear historial de cambios (esto podría expandirse con un modelo de auditoría)
        $history = collect([
            [
                'action' => 'Pedido creado',
                'timestamp' => $order->created_at,
                'details' => "Pedido #{$order->order_number} creado por {$order->user->name}",
                'status' => 'created'
            ]
        ]);

        if ($order->confirmed_at) {
            $history->push([
                'action' => 'Pedido confirmado',
                'timestamp' => $order->confirmed_at,
                'details' => 'Pago verificado y pedido confirmado',
                'status' => 'confirmed'
            ]);
        }

        if ($order->processing_at) {
            $history->push([
                'action' => 'En preparación',
                'timestamp' => $order->processing_at,
                'details' => 'Pedido en proceso de preparación',
                'status' => 'processing'
            ]);
        }

        if ($order->shipped_at) {
            $history->push([
                'action' => 'Enviado',
                'timestamp' => $order->shipped_at,
                'details' => 'Pedido enviado' . ($order->tracking_number ? " (Tracking: {$order->tracking_number})" : ''),
                'status' => 'shipped'
            ]);
        }

        if ($order->delivered_at) {
            $history->push([
                'action' => 'Entregado',
                'timestamp' => $order->delivered_at,
                'details' => 'Pedido entregado exitosamente',
                'status' => 'delivered'
            ]);
        }

        if ($order->cancelled_at) {
            $history->push([
                'action' => 'Cancelado',
                'timestamp' => $order->cancelled_at,
                'details' => 'Pedido cancelado',
                'status' => 'cancelled'
            ]);
        }

        $history = $history->sortBy('timestamp');

        return view('admin.orders.notes', compact('order', 'history'));
    }
}