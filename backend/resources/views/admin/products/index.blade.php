<x-admin-layout>
    <x-slot name="header">
        Gestión de Productos
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div class="flex-1 max-w-lg">
            <form method="GET" class="flex space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Buscar productos..." 
                       class="flex-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                
                <select name="category" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Todas las categorías</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                
                <select name="status" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Todos los estados</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Activo</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactivo</option>
                </select>
                
                <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Buscar
                </button>
            </form>
        </div>
        
        <a href="{{ route('admin.products.create') }}" 
           class="ml-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Nuevo Producto
        </a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 p-4">
            @forelse($products as $product)
                <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                    <div class="flex-shrink-0">
                        @if($product->getFirstMediaUrl('images'))
                            <img class="h-16 w-16 rounded-lg object-cover" src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}">
                        @else
                            <div class="h-16 w-16 rounded-lg bg-gray-300 flex items-center justify-center">
                                <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $product->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $product->category->name ?? 'Sin categoría' }}
                                </p>
                                <p class="text-sm font-semibold text-gray-900">
                                    Bs. {{ number_format($product->price, 2) }}
                                </p>
                            </div>
                            <div class="flex flex-col items-end space-y-1">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($product->status === 'active') bg-green-100 text-green-800 
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($product->status) }}
                                </span>
                                @if($product->is_featured)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Destacado
                                    </span>
                                @endif
                                <span class="text-xs text-gray-500">
                                    Stock: {{ $product->stock_quantity }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-2 flex space-x-2">
                            <a href="{{ route('admin.products.show', $product) }}" 
                               class="text-indigo-600 hover:text-indigo-900 text-xs font-medium">
                                Ver
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" 
                               class="text-indigo-600 hover:text-indigo-900 text-xs font-medium">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                                  class="inline" 
                                  onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-xs font-medium">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8 text-gray-500">
                    No se encontraron productos.
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</x-admin-layout>