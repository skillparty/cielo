<x-public-layout title="Pedido Confirmado">
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Estado del Pedido -->
                    <div class="text-center mb-8">
                        @if($order->status === 'pending_payment')
                            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                                <svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-medium text-gray-900 mb-2">¡Pedido Recibido!</h3>
                            <p class="text-lg text-gray-600">Esperando confirmación de pago</p>
                        @elseif($order->status === 'confirmed')
                            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                                <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-medium text-gray-900 mb-2">¡Pedido Confirmado!</h3>
                            <p class="text-lg text-gray-600">Tu pago ha sido verificado exitosamente</p>
                        @endif
                    </div>

                    <!-- Información del Pedido -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Número de Pedido</h4>
                                <p class="text-lg font-mono text-gray-600">#{{ $order->order_number }}</p>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Fecha de Pedido</h4>
                                <p class="text-lg text-gray-600">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Estado</h4>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($order->status === 'pending_payment') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Total</h4>
                                <p class="text-lg font-semibold text-gray-900">Bs. {{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Entrega -->
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Información de Entrega</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-900 font-medium">{{ $order->delivery_address_line1 }}</p>
                            @if($order->delivery_address_line2)
                                <p class="text-sm text-gray-600">{{ $order->delivery_address_line2 }}</p>
                            @endif
                            <p class="text-sm text-gray-600">{{ $order->delivery_city }}, {{ $order->delivery_state }}</p>
                            <p class="text-sm text-gray-600">Teléfono: {{ $order->delivery_phone }}</p>
                            @if($order->delivery_notes)
                                <p class="text-sm text-gray-600 mt-2">
                                    <span class="font-medium">Notas:</span> {{ $order->delivery_notes }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Detalle de Productos -->
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Productos Pedidos</h4>
                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        @if($item->product && $item->product->getFirstMediaUrl('images'))
                                            <img class="h-16 w-16 rounded-lg object-cover" 
                                                 src="{{ $item->product->getFirstMediaUrl('images') }}" 
                                                 alt="{{ $item->product_name }}">
                                        @else
                                            <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                                <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h5>
                                        <p class="text-sm text-gray-500">
                                            Precio unitario: Bs. {{ number_format($item->unit_price, 2) }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Cantidad: {{ $item->quantity }}
                                        </p>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">
                                        Bs. {{ number_format($item->total_price, 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Resumen de Costos -->
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Resumen de Costos</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Subtotal</span>
                                <span>Bs. {{ number_format($order->subtotal_amount, 2) }}</span>
                            </div>
                            
                            @if($order->delivery_fee > 0)
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Costo de envío</span>
                                    <span>Bs. {{ number_format($order->delivery_fee, 2) }}</span>
                                </div>
                            @else
                                <div class="flex justify-between text-sm text-green-600">
                                    <span>Costo de envío</span>
                                    <span>Gratis</span>
                                </div>
                            @endif
                            
                            @if($order->tax_amount > 0)
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Impuestos</span>
                                    <span>Bs. {{ number_format($order->tax_amount, 2) }}</span>
                                </div>
                            @endif
                            
                            <div class="border-t border-gray-200 pt-2">
                                <div class="flex justify-between text-lg font-medium text-gray-900">
                                    <span>Total</span>
                                    <span>Bs. {{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Pago -->
                    @if($order->payments->count() > 0)
                        <div class="border-b border-gray-200 pb-6 mb-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Información de Pago</h4>
                            @foreach($order->payments as $payment)
                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($payment->status === 'completed') bg-green-100 text-green-800
                                            @elseif($payment->status === 'failed') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-sm text-gray-600 mb-1">
                                        Monto: Bs. {{ number_format($payment->amount, 2) }}
                                    </p>
                                    
                                    @if($payment->transaction_id)
                                        <p class="text-sm text-gray-600 mb-1">
                                            ID de Transacción: {{ $payment->transaction_id }}
                                        </p>
                                    @endif
                                    
                                    <p class="text-sm text-gray-500">
                                        {{ $payment->created_at->format('d/m/Y H:i') }}
                                    </p>

                                    @if($payment->payment_method === 'qr' && $payment->status === 'pending')
                                        <div class="mt-3 p-3 bg-yellow-50 rounded-md">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-yellow-800">
                                                        Verificando pago por QR
                                                    </h3>
                                                    <div class="mt-2 text-sm text-yellow-700">
                                                        <p>Estamos procesando tu comprobante de pago. Te notificaremos por email cuando sea confirmado.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Próximos Pasos -->
                    <div class="bg-blue-50 rounded-lg p-6 mb-6">
                        <h4 class="text-lg font-medium text-blue-900 mb-4">¿Qué sigue?</h4>
                        
                        @if($order->status === 'pending_payment')
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">1</div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-800">
                                            <span class="font-medium">Verificación de pago:</span> 
                                            Nuestro equipo está verificando tu comprobante de pago.
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-gray-100 text-gray-400 text-sm font-medium">2</div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Preparación:</span> 
                                            Una vez confirmado el pago, prepararemos tu pedido.
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-gray-100 text-gray-400 text-sm font-medium">3</div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Envío:</span> 
                                            Te notificaremos cuando tu pedido esté en camino.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-green-100 text-green-600 text-sm font-medium">✓</div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-green-800">
                                            <span class="font-medium">Pago confirmado:</span> 
                                            Tu pago ha sido verificado exitosamente.
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">2</div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-800">
                                            <span class="font-medium">Preparación:</span> 
                                            Estamos preparando tu pedido para el envío.
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-gray-100 text-gray-400 text-sm font-medium">3</div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Envío:</span> 
                                            Te notificaremos cuando tu pedido esté en camino.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('orders.show', $order) }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ver Detalles del Pedido
                        </a>
                        
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Volver al Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>