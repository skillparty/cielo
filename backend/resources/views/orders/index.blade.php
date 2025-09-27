<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    @if($orders->count() > 0)
                        <div class="space-y-6">
                            @foreach($orders as $order)
                                <div class="border border-gray-200 rounded-lg p-6">
                                    <!-- Header del Pedido -->
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                Pedido #{{ $order->order_number }}
                                            </h3>
                                            <p class="text-sm text-gray-500">
                                                {{ $order->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
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
                                            <span class="text-lg font-semibold text-gray-900">
                                                Bs. {{ number_format($order->total_amount, 2) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Productos del Pedido -->
                                    <div class="mb-4">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                            @foreach($order->orderItems->take(3) as $item)
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex-shrink-0">
                                                        @if($item->product && $item->product->getFirstMediaUrl('images'))
                                                            <img class="h-12 w-12 rounded-lg object-cover" 
                                                                 src="{{ $item->product->getFirstMediaUrl('images') }}" 
                                                                 alt="{{ $item->product_name }}">
                                                        @else
                                                            <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-gray-900 truncate">
                                                            {{ $item->product_name }}
                                                        </p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $item->quantity }} × Bs. {{ number_format($item->unit_price, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                            @if($order->orderItems->count() > 3)
                                                <div class="flex items-center justify-center text-sm text-gray-500">
                                                    +{{ $order->orderItems->count() - 3 }} productos más
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Información de Pago -->
                                    @if($order->payments->count() > 0)
                                        <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                @foreach($order->payments as $payment)
                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <span class="text-sm font-medium text-gray-900">
                                                                {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                                            </span>
                                                            <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                                @if($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                                                @elseif($payment->status === 'completed') bg-green-100 text-green-800
                                                                @elseif($payment->status === 'failed') bg-red-100 text-red-800
                                                                @elseif($payment->status === 'refunded') bg-gray-100 text-gray-800
                                                                @else bg-gray-100 text-gray-800 @endif">
                                                                {{ ucfirst($payment->status) }}
                                                            </span>
                                                        </div>
                                                        <span class="text-sm text-gray-600">
                                                            Bs. {{ number_format($payment->amount, 2) }}
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Dirección de Entrega -->
                                    @if($order->status !== 'cancelled')
                                        <div class="mb-4 text-sm text-gray-600">
                                            <span class="font-medium">Entregar en:</span>
                                            {{ $order->delivery_address_line1 }}, {{ $order->delivery_city }}, {{ $order->delivery_state }}
                                        </div>
                                    @endif

                                    <!-- Acciones -->
                                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('orders.show', $order) }}" 
                                               class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                                                Ver Detalles
                                            </a>
                                            
                                            @if(in_array($order->status, ['delivered']))
                                                <form method="POST" action="{{ route('orders.reorder', $order) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="text-green-600 hover:text-green-500 text-sm font-medium">
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
                                                        class="text-red-600 hover:text-red-500 text-sm font-medium">
                                                    Cancelar Pedido
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Paginación -->
                        <div class="mt-6">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <!-- Estado Vacío -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No tienes pedidos</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Cuando realices un pedido, aparecerá aquí.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('products.index') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Comenzar a Comprar
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>