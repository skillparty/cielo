<x-public-layout title="Carrito de Compras">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Carrito de Compras</h1>

            @if($cartItems->count() > 0)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:p-6">
                        <!-- Cart Items -->
                        <div class="space-y-6">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-4 border-b border-gray-200 pb-6">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0 w-20 h-20">
                                        @if($item->product->getFirstMediaUrl('images'))
                                            <img src="{{ $item->product->getFirstMediaUrl('images') }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-full bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-gray-900">
                                            <a href="{{ route('shop.show', $item->product) }}" class="hover:text-red-600">
                                                {{ $item->product->name }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-500">{{ $item->product->sku }}</p>
                                        <p class="text-lg font-semibold text-red-600">
                                            ${{ number_format($item->product->base_price, 2) }}
                                        </p>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center space-x-2">
                                        <form method="POST" action="{{ route('cart.update', $item) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="flex items-center space-x-2">
                                                <button type="button" 
                                                        onclick="decreaseQuantity({{ $item->id }})"
                                                        class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center hover:bg-gray-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                    </svg>
                                                </button>
                                                <input type="number" 
                                                       name="quantity" 
                                                       id="quantity-{{ $item->id }}"
                                                       value="{{ $item->quantity }}" 
                                                       min="1"
                                                       onchange="updateQuantity({{ $item->id }})"
                                                       class="w-16 text-center border-gray-300 rounded-md">
                                                <button type="button"
                                                        onclick="increaseQuantity({{ $item->id }})"
                                                        class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center hover:bg-gray-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900">
                                            ${{ number_format($item->product->base_price * $item->quantity, 2) }}
                                        </p>
                                    </div>

                                    <!-- Remove Button -->
                                    <div>
                                        <form method="POST" action="{{ route('cart.remove', $item) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')"
                                                    class="text-red-600 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Cart Summary -->
                        <div class="mt-8 border-t border-gray-200 pt-6">
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-4">
                                    <a href="{{ route('shop.index') }}" 
                                       class="text-red-600 hover:text-red-800 font-medium">
                                        ← Continuar Comprando
                                    </a>
                                    <form method="POST" action="{{ route('cart.clear') }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('¿Estás seguro de que quieres vaciar el carrito?')"
                                                class="text-gray-600 hover:text-gray-800">
                                            Vaciar Carrito
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="text-right">
                                    <p class="text-lg text-gray-600">Subtotal:</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        ${{ number_format($cartItems->sum(function($item) { return $item->product->base_price * $item->quantity; }), 2) }}
                                    </p>
                                    <a href="{{ route('checkout.index') }}" 
                                       class="mt-4 inline-block bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                                        Proceder al Checkout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 11-4 0v-6m4 0V9a2 2 0 10-4 0v4.01"></path>
                    </svg>
                    <h3 class="text-2xl font-medium text-gray-900 mt-4">Tu carrito está vacío</h3>
                    <p class="text-gray-500 mt-2 mb-8">Agrega algunos productos para continuar con tu compra</p>
                    <a href="{{ route('shop.index') }}" 
                       class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                        Ir a la Tienda
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        function increaseQuantity(itemId) {
            const input = document.getElementById(`quantity-${itemId}`);
            input.value = parseInt(input.value) + 1;
            updateQuantity(itemId);
        }

        function decreaseQuantity(itemId) {
            const input = document.getElementById(`quantity-${itemId}`);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateQuantity(itemId);
            }
        }

        function updateQuantity(itemId) {
            const input = document.getElementById(`quantity-${itemId}`);
            const form = input.closest('form');
            
            // Auto-submit form when quantity changes
            setTimeout(() => {
                form.submit();
            }, 500);
        }
    </script>
</x-public-layout>