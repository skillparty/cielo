<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getOrCreateCart();
        $cart->load(['items.product.media', 'items.product.category']);

        return view('shop.cart', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        // Verificar que el producto esté activo y tenga stock
        if (!$product->is_active) {
            return back()->with('error', 'Producto no disponible.');
        }

        if (!$product->isInStock() || $product->stock < $request->quantity) {
            return back()->with('error', 'Stock insuficiente.');
        }

        $cart = $this->getOrCreateCart();

        // Verificar si el producto ya está en el carrito
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;

            // Verificar stock si existe
            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Stock insuficiente para la cantidad solicitada.');
            }

            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'unit_price' => $product->price,
            ]);
        }

        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        // Verificar que el item pertenece al carrito del usuario actual
        if ($cartItem->cart->user_id !== Auth::id() && $cartItem->cart->session_id !== Session::getId()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:0|max:99',
        ]);

        $product = $cartItem->product;

        if ($request->quantity == 0) {
            $cartItem->delete();
            return back()->with('success', 'Producto eliminado del carrito.');
        }

        // Verificar stock si existe
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stock insuficiente.');
        }

        $cartItem->update([
            'quantity' => $request->quantity,
            'unit_price' => $product->price, // Actualizar precio por si cambió
        ]);

        return back()->with('success', 'Carrito actualizado.');
    }

    public function remove(CartItem $cartItem)
    {
        // Verificar que el item pertenece al carrito del usuario actual
        if ($cartItem->cart->user_id !== Auth::id() && $cartItem->cart->session_id !== Session::getId()) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        $cart = $this->getOrCreateCart();
        $cart->items()->delete();

        return back()->with('success', 'Carrito vaciado.');
    }

    public function count()
    {
        $cart = $this->getOrCreateCart();
        $count = $cart->items()->sum('quantity');

        return response()->json(['count' => $count]);
    }

    private function getOrCreateCart()
    {
        if (Auth::check()) {
            // Usuario autenticado - buscar o crear carrito por user_id
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id(),
            ]);

            // Si hay un carrito de sesión, migrar los items
            $sessionCart = Cart::where('session_id', Session::getId())->first();
            if ($sessionCart && $sessionCart->id !== $cart->id) {
                $this->migrateSessionCartToUserCart($sessionCart, $cart);
                $sessionCart->delete();
            }

            return $cart;
        } else {
            // Usuario no autenticado - buscar o crear carrito por session_id
            return Cart::firstOrCreate([
                'session_id' => Session::getId(),
            ]);
        }
    }

    private function migrateSessionCartToUserCart(Cart $sessionCart, Cart $userCart)
    {
        foreach ($sessionCart->items as $item) {
            // Verificar si el producto ya existe en el carrito del usuario
            $existingItem = $userCart->items()->where('product_id', $item->product_id)->first();

            if ($existingItem) {
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $item->quantity,
                ]);
            } else {
                $userCart->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                ]);
            }
        }
    }
}