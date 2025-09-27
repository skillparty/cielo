<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Pedido #{{ $order->order_number }}
            </h2>
            <a href="{{ route('orders.index') }}" 
               class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                ← Volver a Mis Pedidos
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header del Pedido -->
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">
                                Pedido #{{ $order->order_number }}
                            </h3>
                            <p class="text-gray-600 mt-1">
                                Realizado el {{ $order->created_at->format('d/m/Y \a \l\a\s H:i') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                @if($order->status === 'pending_payment') bg-yellow-100 text-yellow-800
                                @elseif($order->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                                @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                @switch($order->status)
                                    @case('pending_payment')
                                        Esperando Pago
                                        @break
                                    @case('confirmed')
                                        Confirmado
                                        @break
                                    @case('processing')
                                        Preparando
                                        @break
                                    @case('shipped')
                                        En Camino
                                        @break
                                    @case('delivered')
                                        Entregado
                                        @break
                                    @case('cancelled')
                                        Cancelado
                                        @break
                                    @default
                                        {{ ucfirst($order->status) }}
                                @endswitch
                            </span>
                            <div class="text-2xl font-bold text-gray-900 mt-2">
                                Bs. {{ number_format($order->total_amount, 2) }}
                            </div>
                        </div>
                    </div>

                    <!-- Estado del Pedido Timeline -->
                    <div class="mb-8">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Estado del Pedido</h4>
                        <div class="relative">
                            <div class="flex items-center justify-between">
                                <!-- Pedido Recibido -->
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-green-500 text-white text-sm font-medium">
                                        ✓
                                    </div>
                                    <div class="mt-2 text-center">
                                        <div class="text-xs font-medium text-gray-900">Pedido Recibido</div>
                                        <div class="text-xs text-gray-500">{{ $order->created_at->format('d/m H:i') }}</div>
                                    </div>
                                </div>

                                <!-- Línea de conexión -->
                                <div class="flex-1 h-0.5 bg-gray-200 mx-2">
                                    @if(in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered']))
                                        <div class="h-full bg-green-500"></div>
                                    @endif
                                </div>

                                <!-- Pago Confirmado -->
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full 
                                        @if(in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered'])) bg-green-500 text-white
                                        @elseif($order->status === 'pending_payment') bg-yellow-500 text-white
                                        @else bg-gray-300 text-gray-600 @endif text-sm font-medium">
                                        @if(in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered']))
                                            ✓
                                        @elseif($order->status === 'pending_payment')
                                            ⏳
                                        @else
                                            2
                                        @endif
                                    </div>
                                    <div class="mt-2 text-center">
                                        <div class="text-xs font-medium text-gray-900">Pago Confirmado</div>
                                        <div class="text-xs text-gray-500">
                                            @if(in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered']))
                                                Completado
                                            @elseif($order->status === 'pending_payment')
                                                Pendiente
                                            @else
                                                Pendiente
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Línea de conexión -->
                                <div class="flex-1 h-0.5 bg-gray-200 mx-2">
                                    @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                                        <div class="h-full bg-green-500"></div>
                                    @endif
                                </div>

                                <!-- Preparando -->
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full 
                                        @if(in_array($order->status, ['processing', 'shipped', 'delivered'])) bg-green-500 text-white
                                        @elseif($order->status === 'confirmed') bg-blue-500 text-white
                                        @else bg-gray-300 text-gray-600 @endif text-sm font-medium">
                                        @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                                            ✓
                                        @elseif($order->status === 'confirmed')
                                            📦
                                        @else
                                            3
                                        @endif
                                    </div>
                                    <div class="mt-2 text-center">
                                        <div class="text-xs font-medium text-gray-900">Preparando</div>
                                        <div class="text-xs text-gray-500">
                                            @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                                                Completado
                                            @elseif($order->status === 'confirmed')
                                                En proceso
                                            @else
                                                Pendiente
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Línea de conexión -->
                                <div class="flex-1 h-0.5 bg-gray-200 mx-2">
                                    @if(in_array($order->status, ['shipped', 'delivered']))
                                        <div class="h-full bg-green-500"></div>
                                    @endif
                                </div>

                                <!-- En Camino -->
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full 
                                        @if(in_array($order->status, ['shipped', 'delivered'])) bg-green-500 text-white
                                        @elseif($order->status === 'processing') bg-indigo-500 text-white
                                        @else bg-gray-300 text-gray-600 @endif text-sm font-medium">
                                        @if(in_array($order->status, ['shipped', 'delivered']))
                                            ✓
                                        @elseif($order->status === 'processing')
                                            🚚
                                        @else
                                            4
                                        @endif
                                    </div>
                                    <div class="mt-2 text-center">
                                        <div class="text-xs font-medium text-gray-900">En Camino</div>
                                        <div class="text-xs text-gray-500">
                                            @if(in_array($order->status, ['shipped', 'delivered']))
                                                Completado
                                            @elseif($order->status === 'processing')
                                                Próximamente
                                            @else
                                                Pendiente
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Línea de conexión -->
                                <div class="flex-1 h-0.5 bg-gray-200 mx-2">
                                    @if($order->status === 'delivered')
                                        <div class="h-full bg-green-500"></div>
                                    @endif
                                </div>

                                <!-- Entregado -->
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full 
                                        @if($order->status === 'delivered') bg-green-500 text-white
                                        @elseif($order->status === 'shipped') bg-purple-500 text-white
                                        @else bg-gray-300 text-gray-600 @endif text-sm font-medium">
                                        @if($order->status === 'delivered')
                                            ✓
                                        @elseif($order->status === 'shipped')
                                            📍
                                        @else
                                            5
                                        @endif
                                    </div>
                                    <div class="mt-2 text-center">
                                        <div class="text-xs font-medium text-gray-900">Entregado</div>
                                        <div class="text-xs text-gray-500">
                                            @if($order->status === 'delivered')
                                                {{ $order->delivered_at ? $order->delivered_at->format('d/m H:i') : 'Completado' }}
                                            @elseif($order->status === 'shipped')
                                                Próximamente
                                            @else
                                                Pendiente
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Entrega -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Dirección de Entrega</h4>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="font-medium text-gray-900">{{ $order->delivery_address_line1 }}</p>
                                @if($order->delivery_address_line2)
                                    <p class="text-gray-600">{{ $order->delivery_address_line2 }}</p>
                                @endif
                                <p class="text-gray-600">{{ $order->delivery_city }}, {{ $order->delivery_state }}</p>
                                <p class="text-gray-600 mt-2">
                                    <span class="font-medium">Teléfono:</span> {{ $order->delivery_phone }}
                                </p>
                                @if($order->delivery_notes)
                                    <p class="text-gray-600 mt-2">
                                        <span class="font-medium">Notas:</span> {{ $order->delivery_notes }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        @if($order->payments->count() > 0)
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Información de Pago</h4>
                                <div class="space-y-3">
                                    @foreach($order->payments as $payment)
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="font-medium text-gray-900">
                                                    {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                                </span>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                    @if($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($payment->status === 'completed') bg-green-100 text-green-800
                                                    @elseif($payment->status === 'failed') bg-red-100 text-red-800
                                                    @elseif($payment->status === 'refunded') bg-gray-100 text-gray-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600">
                                                Monto: Bs. {{ number_format($payment->amount, 2) }}
                                            </p>
                                            @if($payment->transaction_id)
                                                <p class="text-sm text-gray-600">
                                                    ID: {{ $payment->transaction_id }}
                                                </p>
                                            @endif
                                            <p class="text-sm text-gray-500">
                                                {{ $payment->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Productos del Pedido -->
                    <div class="mb-8">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Productos Pedidos</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
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
                                                Cantidad: {{ $item->quantity }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Precio unitario: Bs. {{ number_format($item->unit_price, 2) }}
                                            </p>
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">
                                            Bs. {{ number_format($item->total_price, 2) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Resumen de Costos -->
                    <div class="border-t border-gray-200 pt-6">
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

                    <!-- Acciones -->
                    <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-6">
                        <div class="flex space-x-4">
                            @if(in_array($order->status, ['delivered']))
                                <form method="POST" action="{{ route('orders.reorder', $order) }}" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Volver a Pedir
                                    </button>
                                </form>
                            @endif
                        </div>

                        @if(in_array($order->status, ['pending_payment', 'confirmed']))
                            <form method="POST" action="{{ route('orders.cancel', $order) }}" 
                                  onsubmit="return confirm('¿Estás seguro de que deseas cancelar este pedido?')" 
                                  class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Cancelar Pedido
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>