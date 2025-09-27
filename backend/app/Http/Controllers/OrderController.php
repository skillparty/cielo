<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['orderItems.product', 'payments'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['orderItems.product', 'payments']);

        return view('orders.show', compact('order'));
    }

    /**
     * Cancel the specified order.
     */
    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Solo se pueden cancelar pedidos en ciertos estados
        if (!in_array($order->status, ['pending_payment', 'confirmed'])) {
            return back()->with('error', 'No se puede cancelar este pedido en su estado actual.');
        }

        $previousStatus = $order->status;
        $order->status = 'cancelled';
        $order->cancelled_at = now();
        $order->save();

        // Restaurar stock si el pedido estaba confirmado
        if ($previousStatus === 'confirmed') {
            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->quantity);
                }
            }
        }

        // Procesar reembolso si hay pagos completados
        $completedPayments = $order->payments->where('status', 'completed');
        foreach ($completedPayments as $payment) {
            $payment->status = 'refunded';
            $payment->refunded_at = now();
            $payment->save();
        }

        // Notificar al usuario
        $order->user->notify(new OrderStatusUpdated($order, $previousStatus, 'Pedido cancelado por solicitud del usuario.'));

        return back()->with('success', 'Pedido cancelado exitosamente. Se procesará el reembolso si aplicable.');
    }

    /**
     * Reorder - Create a new order based on a previous one.
     */
    public function reorder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Verificar disponibilidad de productos
        $unavailableItems = [];
        foreach ($order->orderItems as $item) {
            if (!$item->product || !$item->product->is_active || $item->product->stock < $item->quantity) {
                $unavailableItems[] = $item->product_name;
            }
        }

        if (!empty($unavailableItems)) {
            return back()->with('error', 'Los siguientes productos no están disponibles: ' . implode(', ', $unavailableItems));
        }

        // Agregar productos al carrito
        foreach ($order->orderItems as $item) {
            \App\Models\Cart::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $item->product_id,
                ],
                [
                    'quantity' => $item->quantity,
                ]
            );
        }

        return redirect()->route('cart.index')->with('success', 'Productos agregados al carrito. Puedes modificar las cantidades antes de proceder al checkout.');
    }
}