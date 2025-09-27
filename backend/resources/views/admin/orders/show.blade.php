<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Pedido #{{ $order->order_number }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('admin.orders.notes', $order) }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Historial
                </a>
                <a href="{{ route('admin.orders.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    ← Volver a Lista
                </a>
            </div>
        </div>
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Información Principal -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Header del Pedido -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">Pedido #{{ $order->order_number }}</h3>
                                    <p class="text-gray-600 mt-1">{{ $order->created_at->format('d/m/Y \a \l\a\s H:i') }}</p>
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
                                                Enviado
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

                            <!-- Información del Cliente -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-3">Cliente</h4>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="font-medium text-gray-900">{{ $order->user->name }}</p>
                                        <p class="text-gray-600">{{ $order->user->email }}</p>
                                        @if($order->user->phone)
                                            <p class="text-gray-600">{{ $order->user->phone }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-3">Dirección de Entrega</h4>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="font-medium text-gray-900">{{ $order->delivery_address_line1 }}</p>
                                        @if($order->delivery_address_line2)
                                            <p class="text-gray-600">{{ $order->delivery_address_line2 }}</p>
                                        @endif
                                        <p class="text-gray-600">{{ $order->delivery_city }}, {{ $order->delivery_state }}</p>
                                        <p class="text-gray-600 mt-2">Tel: {{ $order->delivery_phone }}</p>
                                        @if($order->delivery_notes)
                                            <p class="text-gray-600 mt-2">
                                                <span class="font-medium">Notas:</span> {{ $order->delivery_notes }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Productos del Pedido -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Productos Pedidos</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Unit.</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($order->orderItems as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-12 w-12">
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
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                                            @if($item->product)
                                                                <div class="text-sm text-gray-500">SKU: {{ $item->product->sku ?? 'N/A' }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    Bs. {{ number_format($item->unit_price, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    Bs. {{ number_format($item->total_price, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Totales -->
                            <div class="mt-6 flex justify-end">
                                <div class="w-64">
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
                            </div>
                        </div>
                    </div>

                    <!-- Información de Pagos -->
                    @if($order->payments->count() > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Información de Pago</h4>
                                <div class="space-y-4">
                                    @foreach($order->payments as $payment)
                                        <div class="border rounded-lg p-4">
                                            <div class="flex justify-between items-start mb-3">
                                                <div>
                                                    <h5 class="font-medium text-gray-900">
                                                        {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                                    </h5>
                                                    <p class="text-sm text-gray-500">{{ $payment->created_at->format('d/m/Y H:i') }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                        @if($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @elseif($payment->status === 'completed') bg-green-100 text-green-800
                                                        @elseif($payment->status === 'failed') bg-red-100 text-red-800
                                                        @elseif($payment->status === 'refunded') bg-gray-100 text-gray-800
                                                        @else bg-gray-100 text-gray-800 @endif">
                                                        {{ ucfirst($payment->status) }}
                                                    </span>
                                                    <p class="text-lg font-semibold text-gray-900 mt-1">
                                                        Bs. {{ number_format($payment->amount, 2) }}
                                                    </p>
                                                </div>
                                            </div>

                                            @if($payment->transaction_id)
                                                <p class="text-sm text-gray-600 mb-2">
                                                    <span class="font-medium">ID de Transacción:</span> {{ $payment->transaction_id }}
                                                </p>
                                            @endif

                                            @if($payment->gateway_response)
                                                <div class="mt-3 p-3 bg-gray-50 rounded">
                                                    <p class="text-sm font-medium text-gray-700">Respuesta del Gateway:</p>
                                                    <pre class="text-xs text-gray-600 mt-1">{{ json_encode($payment->gateway_response, JSON_PRETTY_PRINT) }}</pre>
                                                </div>
                                            @endif

                                            @if($payment->receipt_url)
                                                <div class="mt-3">
                                                    <a href="{{ $payment->receipt_url }}" target="_blank" 
                                                       class="text-indigo-600 hover:text-indigo-900 text-sm">
                                                        Ver comprobante de pago
                                                    </a>
                                                </div>
                                            @endif

                                            <!-- Acciones de Pago -->
                                            @if($payment->status === 'pending' && $payment->payment_method === 'qr')
                                                <div class="mt-4 flex space-x-3">
                                                    <form method="POST" action="{{ route('admin.orders.verify-payment', $payment) }}" class="inline">
                                                        @csrf
                                                        <input type="hidden" name="action" value="approve">
                                                        <input type="text" name="admin_notes" placeholder="Notas de verificación" 
                                                               class="rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 mr-2">
                                                        <button type="submit" 
                                                                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                                            Aprobar Pago
                                                        </button>
                                                    </form>

                                                    <form method="POST" action="{{ route('admin.orders.verify-payment', $payment) }}" class="inline">
                                                        @csrf
                                                        <input type="hidden" name="action" value="reject">
                                                        <button type="submit" 
                                                                onclick="return confirm('¿Estás seguro de que deseas rechazar este pago?')"
                                                                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                                            Rechazar Pago
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif

                                            @if($payment->status === 'completed')
                                                <div class="mt-4">
                                                    <button type="button" onclick="showRefundModal({{ $payment->id }}, {{ $payment->amount }})" 
                                                            class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                                                        Procesar Reembolso
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Panel de Acciones -->
                <div class="space-y-6">
                    <!-- Actualizar Estado -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Actualizar Estado</h4>
                            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
                                @csrf
                                @method('PATCH')
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                                        <select name="status" id="status" required
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="pending_payment" {{ $order->status === 'pending_payment' ? 'selected' : '' }}>Esperando Pago</option>
                                            <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmado</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Preparando</option>
                                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Enviado</option>
                                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Entregado</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="tracking_number" class="block text-sm font-medium text-gray-700">Número de Seguimiento</label>
                                        <input type="text" name="tracking_number" id="tracking_number" 
                                               value="{{ $order->tracking_number }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <div>
                                        <label for="status_notes" class="block text-sm font-medium text-gray-700">Notas</label>
                                        <textarea name="status_notes" id="status_notes" rows="3"
                                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                  placeholder="Notas adicionales para el cliente...">{{ $order->status_notes }}</textarea>
                                    </div>

                                    <button type="submit" 
                                            class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                        Actualizar Estado
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Información del Sistema</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Creado:</span>
                                    <span class="text-gray-900">{{ $order->created_at->format('d/m/Y H:i:s') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Actualizado:</span>
                                    <span class="text-gray-900">{{ $order->updated_at->format('d/m/Y H:i:s') }}</span>
                                </div>
                                @if($order->confirmed_at)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Confirmado:</span>
                                        <span class="text-gray-900">{{ $order->confirmed_at->format('d/m/Y H:i:s') }}</span>
                                    </div>
                                @endif
                                @if($order->shipped_at)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Enviado:</span>
                                        <span class="text-gray-900">{{ $order->shipped_at->format('d/m/Y H:i:s') }}</span>
                                    </div>
                                @endif
                                @if($order->delivered_at)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Entregado:</span>
                                        <span class="text-gray-900">{{ $order->delivered_at->format('d/m/Y H:i:s') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Reembolso -->
    <div id="refundModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Procesar Reembolso</h3>
                <form id="refundForm" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="refund_amount" class="block text-sm font-medium text-gray-700">Monto a Reembolsar</label>
                            <input type="number" name="refund_amount" id="refund_amount" step="0.01" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        
                        <div>
                            <label for="refund_reason" class="block text-sm font-medium text-gray-700">Motivo del Reembolso</label>
                            <textarea name="refund_reason" id="refund_reason" rows="3" required
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="Describe el motivo del reembolso..."></textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeRefundModal()" 
                                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                            Cancelar
                        </button>
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                            Procesar Reembolso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showRefundModal(paymentId, maxAmount) {
            const modal = document.getElementById('refundModal');
            const form = document.getElementById('refundForm');
            const amountInput = document.getElementById('refund_amount');
            
            form.action = `/admin/orders/payments/${paymentId}/refund`;
            amountInput.max = maxAmount;
            amountInput.value = maxAmount;
            
            modal.classList.remove('hidden');
        }

        function closeRefundModal() {
            document.getElementById('refundModal').classList.add('hidden');
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('refundModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRefundModal();
            }
        });
    </script>
</x-admin-layout>