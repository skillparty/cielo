<x-public-layout title="Carrito de Compras - Cielo Carnes">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-red-600 to-red-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Tu Carrito de Compras</h1>
                <p class="text-lg text-red-100">{{ $cart->items->count() }} producto{{ $cart->items->count() !== 1 ? 's' : '' }} en tu carrito</p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($cart->items->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Lista de productos -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Productos en tu carrito</h2>
                        </div>

                        <div class="divide-y divide-gray-200">
                            @foreach($cart->items as $item)
                                <div class="p-6">
                                    <div class="flex items-center gap-4">
                                        <!-- Imagen del producto -->
                                        <div class="flex-shrink-0">
                                            @if($item->product->getFirstMediaUrl('images'))
                                                <img src="{{ $item->product->getFirstMediaUrl('images', 'thumb') }}"
                                                     alt="{{ $item->product->name }}"
                                                     class="w-20 h-20 object-cover rounded-lg">
                                            @else
                                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Información del producto -->
                                        <div class="flex-grow">
                                            <h3 class="text-lg font-medium text-gray-900">
                                                <a href="{{ route('shop.show', $item->product) }}" class="hover:text-red-600 transition-colors">
                                                    {{ $item->product->name }}
                                                </a>
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">
                                                SKU: {{ $item->product->sku }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                Precio unitario: {{ number_format($item->unit_price, 2) }} BOB
                                            </p>
                                        </div>

                                        <!-- Controles de cantidad y precio -->
                                        <div class="flex items-center gap-4">
                                            <!-- Cantidad -->
                                            <form method="POST" action="{{ route('cart.update', $item) }}" class="flex items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <label class="text-sm text-gray-600">Cant:</label>
                                                <input type="number"
                                                       name="quantity"
                                                       value="{{ $item->quantity }}"
                                                       min="0"
                                                       max="99"
                                                       class="w-16 px-2 py-1 border border-gray-300 rounded text-center text-sm focus:ring-red-500 focus:border-red-500">
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                    Actualizar
                                                </button>
                                            </form>

                                            <!-- Precio total -->
                                            <div class="text-right">
                                                <div class="text-lg font-semibold text-gray-900">
                                                    {{ number_format($item->quantity * $item->unit_price, 2) }} BOB
                                                </div>
                                            </div>

                                            <!-- Eliminar -->
                                            <form method="POST" action="{{ route('cart.remove', $item) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 p-1"
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Stock warning -->
                                    @if($item->product->stock < $item->quantity)
                                        <div class="mt-3 bg-yellow-50 border border-yellow-200 rounded-md p-3">
                                            <div class="flex">
                                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                <div class="ml-3">
                                                    <p class="text-sm text-yellow-800">
                                                        Solo hay {{ $item->product->stock }} unidades disponibles.
                                                        Considera reducir la cantidad.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Acciones del carrito -->
                        <div class="p-6 border-t border-gray-200 bg-gray-50">
                            <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                                <a href="{{ route('shop.index') }}"
                                   class="text-red-600 hover:text-red-800 font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    Continuar comprando
                                </a>

                                <form method="POST" action="{{ route('cart.clear') }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-gray-600 hover:text-gray-800 text-sm"
                                            onclick="return confirm('¿Estás seguro de que quieres vaciar el carrito?')">
                                        Vaciar carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resumen del pedido -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Resumen del pedido</h2>

                        <div class="space-y-4">
                            <!-- Subtotal -->
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="text-gray-900 font-medium">{{ number_format($cart->items->sum(function($item) { return $item->quantity * $item->unit_price; }), 2) }} BOB</span>
                            </div>

                            <!-- Envío -->
                            <div class="flex justify-between">
                                <span class="text-gray-600">Envío</span>
                                <span class="text-gray-900 font-medium">
                                    @php
                                        $subtotal = $cart->items->sum(function($item) { return $item->quantity * $item->unit_price; });
                                        $shipping = $subtotal >= 200 ? 0 : 15;
                                    @endphp
                                    {{ $shipping == 0 ? 'Gratis' : number_format($shipping, 2) . ' BOB' }}
                                </span>
                            </div>

                            @if($subtotal < 200)
                                <div class="text-xs text-gray-500 bg-gray-50 p-2 rounded">
                                    Agrega {{ number_format(200 - $subtotal, 2) }} BOB más para envío gratis
                                </div>
                            @endif

                            <!-- Línea divisoria -->
                            <div class="border-t border-gray-200"></div>

                            <!-- Total -->
                            <div class="flex justify-between text-lg font-semibold">
                                <span class="text-gray-900">Total</span>
                                <span class="text-red-600">{{ number_format($subtotal + $shipping, 2) }} BOB</span>
                            </div>
                        </div>

                        <!-- Botón de checkout -->
                        <div class="mt-8">
                            @auth
                                <a href="{{ route('checkout.index') }}"
                                   class="w-full bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium text-center block transition-colors">
                                    Proceder al pago
                                </a>
                            @else
                                <div class="space-y-3">
                                    <a href="{{ route('login') }}"
                                       class="w-full bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium text-center block transition-colors">
                                        Iniciar sesión para comprar
                                    </a>
                                    <p class="text-xs text-gray-500 text-center">
                                        O <a href="{{ route('register') }}" class="text-red-600 hover:text-red-800">crea una cuenta</a> para continuar
                                    </p>
                                </div>
                            @endauth
                        </div>

                        <!-- Métodos de pago -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-900 mb-3">Métodos de pago aceptados</h3>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Tarjetas de crédito
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Transferencias QR
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Carrito vacío -->
            <div class="max-w-2xl mx-auto text-center py-16">
                <div class="bg-white rounded-lg shadow-md p-8">
                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 11-4 0v-6m4 0V9a2 2 0 10-4 0v4.01"></path>
                    </svg>

                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Tu carrito está vacío</h2>
                    <p class="text-gray-600 mb-8">¡Descubre nuestros deliciosos productos y comienza a llenar tu carrito!</p>

                    <a href="{{ route('shop.index') }}"
                       class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Explorar productos
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-public-layout>