<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = Cart::forUser(Auth::id())
            ->with(['product.media', 'product.category'])
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        // Verificar disponibilidad de productos
        $unavailableItems = [];
        foreach ($cartItems as $item) {
            if (!$item->product || $item->product->status !== 'active') {
                $unavailableItems[] = $item->product->name ?? 'Producto eliminado';
            } elseif ($item->quantity > $item->product->stock_quantity) {
                $unavailableItems[] = "{$item->product->name} (stock insuficiente)";
            }
        }

        if (!empty($unavailableItems)) {
            return redirect()->route('cart.index')
                ->with('error', 'Algunos productos no están disponibles: ' . implode(', ', $unavailableItems));
        }

        // Calcular totales
        $subtotal = $cartItems->sum('total');
        $deliveryFee = $this->calculateDeliveryFee($subtotal);
        $taxAmount = $this->calculateTax($subtotal);
        $total = $subtotal + $deliveryFee + $taxAmount;

        return view('checkout.index', compact(
            'cartItems', 
            'subtotal', 
            'deliveryFee', 
            'taxAmount', 
            'total'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:card,qr,cash_on_delivery',
            'delivery_address_line1' => 'required|string|max:255',
            'delivery_address_line2' => 'nullable|string|max:255',
            'delivery_city' => 'required|string|max:100',
            'delivery_state' => 'required|string|max:100',
            'delivery_postal_code' => 'nullable|string|max:20',
            'delivery_phone' => 'required|string|max:20',
            'delivery_notes' => 'nullable|string|max:1000',
            'receipt_image' => 'required_if:payment_method,qr|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $cartItems = Cart::forUser(Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        try {
            DB::beginTransaction();

            // Verificar stock nuevamente
            foreach ($cartItems as $item) {
                if (!$item->product || $item->product->status !== 'active') {
                    throw new \Exception("El producto {$item->product->name} ya no está disponible.");
                }
                if ($item->quantity > $item->product->stock_quantity) {
                    throw new \Exception("Stock insuficiente para {$item->product->name}.");
                }
            }

            // Calcular totales
            $subtotal = $cartItems->sum('total');
            $deliveryFee = $this->calculateDeliveryFee($subtotal);
            $taxAmount = $this->calculateTax($subtotal);
            $total = $subtotal + $deliveryFee + $taxAmount;

            // Crear la orden
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'currency' => 'BOB',
                'payment_method' => $request->payment_method,
                'delivery_address_line1' => $request->delivery_address_line1,
                'delivery_address_line2' => $request->delivery_address_line2,
                'delivery_city' => $request->delivery_city,
                'delivery_state' => $request->delivery_state,
                'delivery_postal_code' => $request->delivery_postal_code,
                'delivery_phone' => $request->delivery_phone,
                'delivery_notes' => $request->delivery_notes,
                'estimated_delivery_at' => $this->calculateEstimatedDelivery(),
            ]);

            // Crear items de la orden
            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $cartItem->quantity,
                    'price_at_time' => $cartItem->price_at_time,
                    'product_snapshot' => [
                        'name' => $product->name,
                        'description' => $product->description,
                        'image' => $product->getFirstMediaUrl('images'),
                        'category' => $product->category->name ?? null,
                    ],
                ]);

                // Reducir stock
                $product->decrement('stock_quantity', $cartItem->quantity);
            }

            // Crear el pago
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'amount' => $total,
                'currency' => 'BOB',
                'status' => $request->payment_method === 'cash_on_delivery' ? 'pending' : 'processing',
            ]);

            // Procesar el pago según el método
            $this->processPayment($payment, $request);

            // Limpiar carrito
            Cart::clearForUser(Auth::id());
            
            // Enviar notificación
            $user->notify(new \App\Notifications\OrderPlaced($order));

            DB::commit();

            return redirect()->route('checkout.success', $order)
                ->with('success', '¡Pedido realizado exitosamente!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en checkout: ' . $e->getMessage());
            
            return back()->withInput()
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['orderItems.product', 'payments']);

        // Verificar si hay pagos completados para mostrar confirmación
        $payment = $order->payments->where('status', 'completed')->first();
        if ($payment && $order->status !== 'confirmed') {
            $order->status = 'confirmed';
            $order->save();
            
            // Notificar confirmación de pago
            $order->user->notify(new \App\Notifications\PaymentConfirmed($order, $payment));
        }

        return view('checkout.success', compact('order'));
    }

    public function uploadReceipt(Request $request, Payment $payment)
    {
        $request->validate([
            'receipt_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($payment->order->user_id !== Auth::id()) {
            abort(403);
        }

        try {
            $file = $request->file('receipt_image');
            $filename = 'receipts/' . $payment->id . '_' . time() . '.' . $file->extension();
            $path = $file->storeAs('public', $filename);

            $payment->update([
                'receipt_file_path' => $filename,
                'status' => 'verification_required',
                'verification_status' => 'pending',
            ]);

            $payment->order->update(['status' => 'payment_verification']);

            return back()->with('success', 'Comprobante subido exitosamente. Tu pago será verificado pronto.');

        } catch (\Exception $e) {
            Log::error('Error subiendo comprobante: ' . $e->getMessage());
            return back()->with('error', 'Error al subir el comprobante.');
        }
    }

    private function processPayment(Payment $payment, Request $request)
    {
        switch ($payment->payment_method) {
            case 'qr':
                if ($request->hasFile('receipt_image')) {
                    $file = $request->file('receipt_image');
                    $filename = 'receipts/' . $payment->id . '_' . time() . '.' . $file->extension();
                    $path = $file->storeAs('public', $filename);

                    $payment->update([
                        'receipt_file_path' => $filename,
                        'status' => 'verification_required',
                        'verification_status' => 'pending',
                    ]);

                    $payment->order->update(['status' => 'payment_verification']);
                } else {
                    $payment->order->update(['status' => 'payment_pending']);
                }
                break;

            case 'card':
                // Aquí se integraría con la pasarela de pago
                $payment->update(['status' => 'pending']);
                $payment->order->update(['status' => 'payment_pending']);
                break;

            case 'cash_on_delivery':
                $payment->update(['status' => 'pending']);
                $payment->order->update(['status' => 'preparing']);
                break;
        }
    }

    private function calculateDeliveryFee(float $subtotal): float
    {
        // Envío gratis para pedidos mayores a 200 BOB
        if ($subtotal >= 200) {
            return 0;
        }

        // Envío fijo de 25 BOB para pedidos menores
        return 25;
    }

    private function calculateTax(float $subtotal): float
    {
        // Sin impuestos por ahora, pero se puede implementar
        return 0;
    }

    private function calculateEstimatedDelivery()
    {
        // Estimación de entrega: 2-3 días hábiles
        return now()->addWeekdays(2);
    }
}