<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gestión de Pedidos') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('admin.orders.export', request()->query()) }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Exportar
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

            <!-- Estadísticas Rápidas -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-blue-600">{{ $stats['total_orders'] }}</div>
                    <div class="text-sm text-gray-600">Total</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending_orders'] }}</div>
                    <div class="text-sm text-gray-600">Pendientes</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-green-600">{{ $stats['confirmed_orders'] }}</div>
                    <div class="text-sm text-gray-600">Confirmados</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-blue-600">{{ $stats['processing_orders'] }}</div>
                    <div class="text-sm text-gray-600">Preparando</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-indigo-600">{{ $stats['shipped_orders'] }}</div>
                    <div class="text-sm text-gray-600">Enviados</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-green-600">{{ $stats['delivered_orders'] }}</div>
                    <div class="text-sm text-gray-600">Entregados</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-red-600">{{ $stats['cancelled_orders'] }}</div>
                    <div class="text-sm text-gray-600">Cancelados</div>
                </div>
            </div>

            <!-- Filtros -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Filtros</h3>
                    <form method="GET" action="{{ route('admin.orders.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Todos los estados</option>
                                <option value="pending_payment" {{ request('status') === 'pending_payment' ? 'selected' : '' }}>Esperando Pago</option>
                                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmado</option>
                                <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Preparando</option>
                                <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Enviado</option>
                                <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Entregado</option>
                                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>

                        <div>
                            <label for="payment_method" class="block text-sm font-medium text-gray-700">Método de Pago</label>
                            <select name="payment_method" id="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Todos los métodos</option>
                                <option value="qr" {{ request('payment_method') === 'qr' ? 'selected' : '' }}>Código QR</option>
                                <option value="cash_on_delivery" {{ request('payment_method') === 'cash_on_delivery' ? 'selected' : '' }}>Efectivo</option>
                                <option value="card" {{ request('payment_method') === 'card' ? 'selected' : '' }}>Tarjeta</option>
                            </select>
                        </div>

                        <div>
                            <label for="date_from" class="block text-sm font-medium text-gray-700">Desde</label>
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="date_to" class="block text-sm font-medium text-gray-700">Hasta</label>
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Buscar</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                   placeholder="Número de pedido, cliente..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="min_amount" class="block text-sm font-medium text-gray-700">Monto Mín.</label>
                            <input type="number" name="min_amount" id="min_amount" value="{{ request('min_amount') }}" 
                                   step="0.01" placeholder="0.00"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="max_amount" class="block text-sm font-medium text-gray-700">Monto Máx.</label>
                            <input type="number" name="max_amount" id="max_amount" value="{{ request('max_amount') }}" 
                                   step="0.01" placeholder="1000.00"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 mr-2">
                                Filtrar
                            </button>
                            <a href="{{ route('admin.orders.index') }}" class="w-full bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 text-center">
                                Limpiar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabla de Pedidos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="select-all" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pedido
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cliente
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pago
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="order_ids[]" value="{{ $order->id }}" class="order-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">
                                                #{{ $order->order_number }}
                                            </a>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $order->orderItems->count() }} productos
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($order->payments->count() > 0)
                                            @foreach($order->payments as $payment)
                                                <div class="text-sm text-gray-900">
                                                    {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                                </div>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                    @if($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($payment->status === 'completed') bg-green-100 text-green-800
                                                    @elseif($payment->status === 'failed') bg-red-100 text-red-800
                                                    @elseif($payment->status === 'refunded') bg-gray-100 text-gray-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-sm text-gray-500">Sin pago</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Bs. {{ number_format($order->total_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>{{ $order->created_at->format('d/m/Y') }}</div>
                                        <div>{{ $order->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.orders.show', $order) }}" 
                                               class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                            
                                            @if($order->payments->where('status', 'pending')->count() > 0)
                                                <a href="{{ route('admin.orders.show', $order) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900">Verificar</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                        No se encontraron pedidos con los filtros aplicados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Acciones en Lote -->
                <div id="bulk-actions" class="hidden bg-gray-50 px-6 py-3 border-t border-gray-200">
                    <form method="POST" action="{{ route('admin.orders.bulk-action') }}" class="flex items-center space-x-4">
                        @csrf
                        <div id="selected-orders"></div>
                        
                        <select name="action" required class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Seleccionar acción</option>
                            <option value="update_status">Actualizar estado</option>
                            <option value="export">Exportar seleccionados</option>
                            <option value="delete">Eliminar (solo cancelados)</option>
                        </select>

                        <select name="bulk_status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" style="display: none;">
                            <option value="">Seleccionar estado</option>
                            <option value="confirmed">Confirmado</option>
                            <option value="processing">Preparando</option>
                            <option value="shipped">Enviado</option>
                            <option value="delivered">Entregado</option>
                            <option value="cancelled">Cancelado</option>
                        </select>

                        <input type="text" name="bulk_notes" placeholder="Notas (opcional)" 
                               class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" style="display: none;">

                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Aplicar
                        </button>
                    </form>
                </div>
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    <script>
        // Manejar selección múltiple
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.order-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActions();
        });

        document.querySelectorAll('.order-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkActions);
        });

        function updateBulkActions() {
            const checkedBoxes = document.querySelectorAll('.order-checkbox:checked');
            const bulkActions = document.getElementById('bulk-actions');
            const selectedOrders = document.getElementById('selected-orders');

            if (checkedBoxes.length > 0) {
                bulkActions.classList.remove('hidden');
                selectedOrders.innerHTML = '';
                checkedBoxes.forEach(checkbox => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'order_ids[]';
                    input.value = checkbox.value;
                    selectedOrders.appendChild(input);
                });
            } else {
                bulkActions.classList.add('hidden');
            }
        }

        // Mostrar/ocultar campos según la acción seleccionada
        document.querySelector('select[name="action"]').addEventListener('change', function() {
            const statusSelect = document.querySelector('select[name="bulk_status"]');
            const notesInput = document.querySelector('input[name="bulk_notes"]');
            
            if (this.value === 'update_status') {
                statusSelect.style.display = 'block';
                notesInput.style.display = 'block';
                statusSelect.required = true;
            } else {
                statusSelect.style.display = 'none';
                notesInput.style.display = 'none';
                statusSelect.required = false;
            }
        });
    </script>
</x-admin-layout>