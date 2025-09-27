<x-public-layout title="Checkout - Cielo Carnes">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-red-600 to-red-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Finalizar Compra</h1>
                <p class="text-lg text-red-100">Completa tu pedido y recibe nuestros productos frescos</p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form method="POST" action="{{ route('checkout.store') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            <!-- Información de envío y pago -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Información de envío -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Información de Envío</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="shipping_address_line1" class="block text-sm font-medium text-gray-700 mb-2">
                                Dirección *
                            </label>
                            <input type="text"
                                   id="shipping_address_line1"
                                   name="shipping_address_line1"
                                   value="{{ old('shipping_address_line1', Auth::user()?->address_line1) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('shipping_address_line1') border-red-500 @enderror">
                            @error('shipping_address_line1')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="shipping_address_line2" class="block text-sm font-medium text-gray-700 mb-2">
                                Dirección adicional
                            </label>
                            <input type="text"
                                   id="shipping_address_line2"
                                   name="shipping_address_line2"
                                   value="{{ old('shipping_address_line2', Auth::user()?->address_line2) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500">
                        </div>

                        <div>
                            <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-2">
                                Ciudad *
                            </label>
                            <input type="text"
                                   id="shipping_city"
                                   name="shipping_city"
                                   value="{{ old('shipping_city', Auth::user()?->city) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('shipping_city') border-red-500 @enderror">
                            @error('shipping_city')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="shipping_state" class="block text-sm font-medium text-gray-700 mb-2">
                                Departamento *
                            </label>
                            <input type="text"
                                   id="shipping_state"
                                   name="shipping_state"
                                   value="{{ old('shipping_state', Auth::user()?->state) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('shipping_state') border-red-500 @enderror">
                            @error('shipping_state')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700 mb-2">
                                Código Postal *
                            </label>
                            <input type="text"
                                   id="shipping_postal_code"
                                   name="shipping_postal_code"
                                   value="{{ old('shipping_postal_code', Auth::user()?->postal_code) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('shipping_postal_code') border-red-500 @enderror">
                            @error('shipping_postal_code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Teléfono de contacto *
                            </label>
                            <input type="tel"
                                   id="shipping_phone"
                                   name="shipping_phone"
                                   value="{{ old('shipping_phone', Auth::user()?->phone) }}"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('shipping_phone') border-red-500 @enderror">
                            @error('shipping_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notas adicionales (opcional)
                        </label>
                        <textarea id="notes"
                                  name="notes"
                                  rows="3"
                                  placeholder="Instrucciones especiales de entrega, etc."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <!-- Método de pago -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Método de Pago</h2>

                    <div class="space-y-4">
                        <!-- Tarjeta de crédito -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio"
                                       name="payment_method"
                                       value="card"
                                       {{ old('payment_method', 'card') == 'card' ? 'checked' : '' }}
                                       class="text-red-600 focus:ring-red-500">
                                <span class="ml-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-900">Tarjeta de Crédito/Débito</div>
                                        <div class="text-sm text-gray-600">Visa, Mastercard, American Express</div>
                                    </div>
                                </span>
                            </label>
                        </div>

                        <!-- Pago QR -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio"
                                       name="payment_method"
                                       value="qr"
                                       {{ old('payment_method') == 'qr' ? 'checked' : '' }}
                                       class="text-red-600 focus:ring-red-500">
                                <span class="ml-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 010 2H6.414l2.293 2.293a1 1 0 11-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h3a1 1 0 011 1v3a1 1 0 01-2 0V6.414l-2.293 2.293a1 1 0 11-1.414-1.414L13.586 5H12zm-9 7a1 1 0 012 0v1.586l2.293-2.293a1 1 0 111.414 1.414L6.414 15H8a1 1 0 010 2H4a1 1 0 01-1-1v-3zm13-1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 010-2h1.586l-2.293-2.293a1 1 0 111.414-1.414L15 13.586V12a1 1 0 011-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-900">Transferencia QR</div>
                                        <div class="text-sm text-gray-600">Pago mediante código QR (automático)</div>
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>

                    @error('payment_method')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Resumen del pedido -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Resumen del Pedido</h2>

                    <!-- Productos -->
                    <div class="space-y-4 mb-6">
                        @foreach($cart->items as $item)
                            <div class="flex items-center gap-3 pb-4 border-b border-gray-100 last:border-b-0 last:pb-0">
                                <div class="flex-shrink-0">
                                    @if($item->product->getFirstMediaUrl('images'))
                                        <img src="{{ $item->product->getFirstMediaUrl('images', 'thumb') }}"
                                             alt="{{ $item->product->name }}"
                                             class="w-12 h-12 object-cover rounded">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 truncate">{{ $item->product->name }}</h4>
                                    <p class="text-sm text-gray-600">Cant: {{ $item->quantity }} × {{ number_format($item->unit_price, 2) }} BOB</p>
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ number_format($item->quantity * $item->unit_price, 2) }} BOB
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Totales -->
                    <div class="border-t border-gray-200 pt-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-900">{{ number_format($subtotal, 2) }} BOB</span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Envío</span>
                            <span class="text-gray-900">{{ $shipping == 0 ? 'Gratis' : number_format($shipping, 2) . ' BOB' }}</span>
                        </div>

                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between text-lg font-semibold">
                                <span class="text-gray-900">Total</span>
                                <span class="text-red-600">{{ number_format($total, 2) }} BOB</span>
                            </div>
                        </div>
                    </div>

                    <!-- Información de envío -->
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Información de Envío</h3>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p>🕒 Entrega: 2-4 horas en área metropolitana</p>
                            <p>📦 Envío gratis en pedidos mayores a 200 BOB</p>
                            <p>✅ Pago contra entrega disponible</p>
                        </div>
                    </div>

                    <!-- Botón de confirmar pedido -->
                    <div class="mt-6">
                        <button type="submit"
                                class="w-full bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Confirmar Pedido
                        </button>
                    </div>

                    <!-- Enlaces -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('cart.index') }}" class="text-sm text-red-600 hover:text-red-800">
                            ← Volver al carrito
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-public-layout>