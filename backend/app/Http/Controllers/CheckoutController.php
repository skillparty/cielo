<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('shop.index')->with('error', 'Tu carrito está vacío.');
        }

        $cart->load(['items.product.media', 'items.product.category']);

        // Calcular totales
        $subtotal = $cart->items->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        $shipping = $this->calculateShipping($cart);
        $total = $subtotal + $shipping;

        return view('shop.checkout', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $cart = $this->getCart();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('shop.index')->with('error', 'Tu carrito está vacío.');
        }

        $request->validate([
            'payment_method' => 'required|in:card,qr',
            'shipping_address_line1' => 'required|string|max:255',
            'shipping_address_line2' => 'nullable|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_state' => 'required|string|max:100',
            'shipping_postal_code' => 'required|string|max:20',
            'shipping_phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        // Verificar stock de todos los productos
        foreach ($cart->items as $item) {
            $product = $item->product;

            if (!$product->is_active) {
                return back()->with('error', "El producto {$product->name} ya no está disponible.");
            }

            if (!$product->isInStock() || $product->stock < $item->quantity) {
                return back()->with('error', "Stock insuficiente para {$product->name}. Disponible: {$product->stock}");
            }
        }

        DB::transaction(function () use ($request, $cart) {
            // Calcular totales
            $subtotal = $cart->items->sum(function ($item) {
                return $item->quantity * $item->unit_price;
            });
            $shipping = $this->calculateShipping($cart);
            $total = $subtotal + $shipping;

            // Crear la orden
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $this->generateOrderNumber(),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_cost' => $shipping,
                'total' => $total,
                'shipping_address_line1' => $request->shipping_address_line1,
                'shipping_address_line2' => $request->shipping_address_line2,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_phone' => $request->shipping_phone,
                'notes' => $request->notes,
                'payment_method' => $request->payment_method,
            ]);

            // Crear items de la orden
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product->name,
                    'product_sku' => $cartItem->product->sku,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $cartItem->unit_price,
                    'total' => $cartItem->quantity * $cartItem->unit_price,
                    'product_data' => $cartItem->product->toArray(),
                ]);

                // Reducir stock si aplica
                if ($cartItem->product->stock > 0) {
                    $cartItem->product->decrement('stock', $cartItem->quantity);
                }
            }

            // Crear registro de pago
            Payment::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'amount' => $total,
                'currency' => 'BOB',
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'reference_number' => $this->generatePaymentReference(),
            ]);

            // Limpiar carrito
            $cart->items()->delete();
        });

        return redirect()->route('checkout.success')->with('success', '¡Pedido realizado exitosamente!');
    }

    public function success()
    {
        return view('shop.checkout-success');
    }

    private function getCart()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->with('items.product')->first();
        } else {
            return Cart::where('session_id', Session::getId())->with('items.product')->first();
        }
    }

    private function calculateShipping(Cart $cart)
    {
        // Lógica simple de envío - se puede hacer más compleja según necesidades
        $subtotal = $cart->items->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        // Envío gratis para pedidos mayores a 200 BOB
        if ($subtotal >= 200) {
            return 0;
        }

        // Envío fijo de 15 BOB para pedidos menores
        return 15;
    }

    private function generateOrderNumber()
    {
        do {
            $number = 'ORD-' . date('Y') . '-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }

    private function generatePaymentReference()
    {
        return 'PAY-' . time() . '-' . mt_rand(1000, 9999);
    }
}