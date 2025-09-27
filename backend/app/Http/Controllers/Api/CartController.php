<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Get cart contents
     */
    public function index(Request $request): JsonResponse
    {
        $sessionId = $this->getSessionId($request);
        
        $cartItems = Cart::with(['product.media', 'product.category'])
            ->where('session_id', $sessionId)
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        return response()->json([
            'data' => [
                'items' => $cartItems,
                'total' => $total,
                'count' => $cartItems->sum('quantity')
            ]
        ]);
    }

    /**
     * Add item to cart
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0.1',
        ]);

        $product = Product::active()->findOrFail($request->product_id);
        $sessionId = $this->getSessionId($request);

        // Check if item already exists in cart
        $cartItem = Cart::where('session_id', $sessionId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Update quantity
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Create new cart item
            $cartItem = Cart::create([
                'session_id' => $sessionId,
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'unit_price' => $product->getCurrentPrice(),
            ]);
        }

        return response()->json([
            'message' => 'Producto agregado al carrito',
            'data' => $cartItem->load(['product.media', 'product.category'])
        ]);
    }

    /**
     * Update cart item
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0',
        ]);

        $sessionId = $this->getSessionId($request);
        
        $cartItem = Cart::where('session_id', $sessionId)
            ->findOrFail($id);

        if ($request->quantity == 0) {
            $cartItem->delete();
            return response()->json(['message' => 'Producto eliminado del carrito']);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json([
            'message' => 'Carrito actualizado',
            'data' => $cartItem->load(['product.media', 'product.category'])
        ]);
    }

    /**
     * Remove item from cart
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        $sessionId = $this->getSessionId($request);
        
        $cartItem = Cart::where('session_id', $sessionId)
            ->findOrFail($id);

        $cartItem->delete();

        return response()->json(['message' => 'Producto eliminado del carrito']);
    }

    /**
     * Clear entire cart
     */
    public function clear(Request $request): JsonResponse
    {
        $sessionId = $this->getSessionId($request);
        
        Cart::where('session_id', $sessionId)->delete();

        return response()->json(['message' => 'Carrito vaciado']);
    }

    /**
     * Get cart count
     */
    public function count(Request $request): JsonResponse
    {
        $sessionId = $this->getSessionId($request);
        
        $count = Cart::where('session_id', $sessionId)
            ->sum('quantity');

        return response()->json(['count' => $count]);
    }

    /**
     * Get or create session ID
     */
    private function getSessionId(Request $request): string
    {
        if (Auth::check()) {
            return 'user_' . Auth::id();
        }

        $sessionId = $request->header('X-Session-ID');
        
        if (!$sessionId) {
            $sessionId = 'guest_' . Str::random(32);
        }

        return $sessionId;
    }
}
