<x-public-layout title="Checkout">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Formulario de Checkout -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-6">Información de Entrega</h3>
                        
                        <form method="POST" action="{{ route('checkout.store') }}" enctype="multipart/form-data" id="checkout-form">
                            @csrf
                            
                            <!-- Dirección de Entrega -->
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="delivery_address_line1" class="block text-sm font-medium text-gray-700">
                                        Dirección *
                                    </label>
                                    <input type="text" name="delivery_address_line1" id="delivery_address_line1" 
                                           value="{{ old('delivery_address_line1', auth()->user()->address_line1) }}" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('delivery_address_line1') border-red-300 @enderror">
                                    @error('delivery_address_line1')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="delivery_address_line2" class="block text-sm font-medium text-gray-700">
                                        Referencia (opcional)
                                    </label>
                                    <input type="text" name="delivery_address_line2" id="delivery_address_line2" 
                                           value="{{ old('delivery_address_line2') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="delivery_city" class="block text-sm font-medium text-gray-700">
                                            Ciudad *
                                        </label>
                                        <input type="text" name="delivery_city" id="delivery_city" 
                                               value="{{ old('delivery_city', auth()->user()->city) }}" required
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('delivery_city') border-red-300 @enderror">
                                        @error('delivery_city')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="delivery_state" class="block text-sm font-medium text-gray-700">
                                            Departamento *
                                        </label>
                                        <select name="delivery_state" id="delivery_state" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('delivery_state') border-red-300 @enderror">
                                            <option value="">Seleccionar</option>
                                            <option value="La Paz" {{ old('delivery_state', auth()->user()->state) === 'La Paz' ? 'selected' : '' }}>La Paz</option>
                                            <option value="Santa Cruz" {{ old('delivery_state', auth()->user()->state) === 'Santa Cruz' ? 'selected' : '' }}>Santa Cruz</option>
                                            <option value="Cochabamba" {{ old('delivery_state', auth()->user()->state) === 'Cochabamba' ? 'selected' : '' }}>Cochabamba</option>
                                            <option value="Oruro" {{ old('delivery_state', auth()->user()->state) === 'Oruro' ? 'selected' : '' }}>Oruro</option>
                                            <option value="Potosí" {{ old('delivery_state', auth()->user()->state) === 'Potosí' ? 'selected' : '' }}>Potosí</option>
                                            <option value="Tarija" {{ old('delivery_state', auth()->user()->state) === 'Tarija' ? 'selected' : '' }}>Tarija</option>
                                            <option value="Chuquisaca" {{ old('delivery_state', auth()->user()->state) === 'Chuquisaca' ? 'selected' : '' }}>Chuquisaca</option>
                                            <option value="Beni" {{ old('delivery_state', auth()->user()->state) === 'Beni' ? 'selected' : '' }}>Beni</option>
                                            <option value="Pando" {{ old('delivery_state', auth()->user()->state) === 'Pando' ? 'selected' : '' }}>Pando</option>
                                        </select>
                                        @error('delivery_state')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="delivery_phone" class="block text-sm font-medium text-gray-700">
                                        Teléfono de Contacto *
                                    </label>
                                    <input type="tel" name="delivery_phone" id="delivery_phone" 
                                           value="{{ old('delivery_phone', auth()->user()->phone) }}" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('delivery_phone') border-red-300 @enderror">
                                    @error('delivery_phone')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="delivery_notes" class="block text-sm font-medium text-gray-700">
                                        Notas de Entrega (opcional)
                                    </label>
                                    <textarea name="delivery_notes" id="delivery_notes" rows="3" 
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                              placeholder="Ej: Casa de color azul, segundo piso, etc.">{{ old('delivery_notes') }}</textarea>
                                </div>
                            </div>

                            <!-- Método de Pago -->
                            <div class="mt-8">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Método de Pago</h3>
                                
                                <div class="space-y-4">
                                    <!-- Código QR -->
                                    <div class="flex items-center">
                                        <input id="payment_qr" name="payment_method" type="radio" value="qr" 
                                               {{ old('payment_method') === 'qr' ? 'checked' : '' }}
                                               class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="payment_qr" class="ml-3 block text-sm font-medium text-gray-700">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 4h4m0 0V2m0 2h2m-6 0h2m0 0h2m-8 4h.01M8 8h4m0 0V4m0 4h2"></path>
                                                </svg>
                                                Código QR (Recomendado)
                                            </div>
                                            <p class="text-xs text-gray-500 ml-7">Paga con QR de tu banco móvil</p>
                                        </label>
                                    </div>

                                    <!-- Efectivo Contra Entrega -->
                                    <div class="flex items-center">
                                        <input id="payment_cash" name="payment_method" type="radio" value="cash_on_delivery" 
                                               {{ old('payment_method', 'cash_on_delivery') === 'cash_on_delivery' ? 'checked' : '' }}
                                               class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="payment_cash" class="ml-3 block text-sm font-medium text-gray-700">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                Efectivo Contra Entrega
                                            </div>
                                            <p class="text-xs text-gray-500 ml-7">Paga cuando recibas tu pedido</p>
                                        </label>
                                    </div>
                                </div>

                                @error('payment_method')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Subir Comprobante QR -->
                            <div id="qr-upload" class="mt-6 hidden">
                                <label for="receipt_image" class="block text-sm font-medium text-gray-700">
                                    Comprobante de Pago *
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="receipt_image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Subir comprobante</span>
                                                <input id="receipt_image" name="receipt_image" type="file" accept="image/*" class="sr-only">
                                            </label>
                                            <p class="pl-1">o arrastra y suelta</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG hasta 5MB</p>
                                    </div>
                                </div>
                                @error('receipt_image')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Botón de Envío -->
                            <div class="mt-8">
                                <button type="submit" 
                                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Finalizar Pedido
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Resumen del Pedido -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-6">Resumen del Pedido</h3>
                        
                        <!-- Items del Carrito -->
                        <div class="space-y-4 mb-6">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        @if($item->product && $item->product->getFirstMediaUrl('images'))
                                            <img class="h-16 w-16 rounded-lg object-cover" 
                                                 src="{{ $item->product->getFirstMediaUrl('images') }}" 
                                                 alt="{{ $item->product->name }}">
                                        @else
                                            <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                                <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-900">
                                            {{ $item->product->name ?? 'Producto eliminado' }}
                                        </h4>
                                        <p class="text-sm text-gray-500">
                                            Cantidad: {{ $item->quantity }}
                                        </p>
                                        <p class="text-sm font-medium text-gray-900">
                                            Bs. {{ number_format($item->total, 2) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Totales -->
                        <div class="border-t border-gray-200 pt-4 space-y-2">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Subtotal</span>
                                <span>Bs. {{ number_format($subtotal, 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Envío</span>
                                <span>
                                    @if($deliveryFee > 0)
                                        Bs. {{ number_format($deliveryFee, 2) }}
                                    @else
                                        Gratis
                                    @endif
                                </span>
                            </div>
                            
                            @if($taxAmount > 0)
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Impuestos</span>
                                    <span>Bs. {{ number_format($taxAmount, 2) }}</span>
                                </div>
                            @endif
                            
                            <div class="border-t border-gray-200 pt-2">
                                <div class="flex justify-between text-lg font-medium text-gray-900">
                                    <span>Total</span>
                                    <span>Bs. {{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Información Adicional -->
                        <div class="mt-6 text-sm text-gray-500">
                            <p class="mb-2">
                                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Entrega estimada: 2-3 días hábiles
                            </p>
                            
                            @if($deliveryFee == 0)
                                <p class="mb-2">
                                    <svg class="inline w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    ¡Envío gratis por compras mayores a Bs. 200!
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
            const qrUpload = document.getElementById('qr-upload');
            const receiptInput = document.getElementById('receipt_image');

            function toggleQrUpload() {
                const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
                if (selectedMethod && selectedMethod.value === 'qr') {
                    qrUpload.classList.remove('hidden');
                    receiptInput.required = true;
                } else {
                    qrUpload.classList.add('hidden');
                    receiptInput.required = false;
                }
            }

            paymentRadios.forEach(radio => {
                radio.addEventListener('change', toggleQrUpload);
            });

            // Inicializar
            toggleQrUpload();
        });
    </script>
</x-public-layout>