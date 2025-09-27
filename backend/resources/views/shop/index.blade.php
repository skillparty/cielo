<x-public-layout title="Tienda - Cielo Carnes">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-red-600 to-red-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Nuestra Tienda</h1>
                <p class="text-xl md:text-2xl mb-8">Descubre nuestros productos de la más alta calidad</p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar con filtros -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filtros</h3>

                    <!-- Búsqueda -->
                    <form method="GET" action="{{ route('shop.index') }}" class="mb-6">
                        <div class="relative">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Buscar productos..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </form>

                    <!-- Categorías -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Categorías</h4>
                        <div class="space-y-2">
                            <a href="{{ route('shop.index') }}"
                               class="block px-3 py-2 text-sm {{ !request('category') ? 'bg-red-100 text-red-700 rounded-md' : 'text-gray-600 hover:text-red-600' }}">
                                Todas las categorías
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('shop.category', $category) }}"
                                   class="block px-3 py-2 text-sm {{ request('category') == $category->id ? 'bg-red-100 text-red-700 rounded-md' : 'text-gray-600 hover:text-red-600' }}">
                                    {{ $category->name }}
                                    @if($category->children->count() > 0)
                                        <span class="text-xs text-gray-400">({{ $category->children->count() }})</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Rango de precios -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Precio</h4>
                        <div class="space-y-2">
                            <div class="flex gap-2">
                                <input type="number"
                                       name="min_price"
                                       value="{{ request('min_price') }}"
                                       placeholder="Min"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-red-500 focus:border-red-500">
                                <input type="number"
                                       name="max_price"
                                       value="{{ request('max_price') }}"
                                       placeholder="Max"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-red-500 focus:border-red-500">
                            </div>
                        </div>
                    </div>

                    <!-- Botón aplicar filtros -->
                    <button type="submit"
                            form="filters-form"
                            class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Aplicar Filtros
                    </button>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="lg:w-3/4">
                <!-- Header con ordenamiento -->
                <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-sm text-gray-600">
                            Mostrando {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} de {{ $products->total() }} productos
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600">Ordenar por:</span>
                            <select name="sort"
                                    form="filters-form"
                                    class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:ring-red-500 focus:border-red-500">
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Precio</option>
                            </select>

                            <select name="direction"
                                    form="filters-form"
                                    class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:ring-red-500 focus:border-red-500">
                                <option value="asc" {{ request('direction', 'asc') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descendente</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Formulario oculto para filtros -->
                <form id="filters-form" method="GET" action="{{ route('shop.index') }}" class="hidden">
                    @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                    @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                    @if(request('min_price'))<input type="hidden" name="min_price" value="{{ request('min_price') }}">@endif
                    @if(request('max_price'))<input type="hidden" name="max_price" value="{{ request('max_price') }}">@endif
                </form>

                <!-- Grid de productos -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                <!-- Imagen del producto -->
                                <div class="relative">
                                    @if($product->getFirstMediaUrl('images'))
                                        <img src="{{ $product->getFirstMediaUrl('images', 'thumb') }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif

                                    @if($product->is_featured)
                                        <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 rounded text-xs font-medium">
                                            Destacado
                                        </div>
                                    @endif

                                    @if($product->isLowStock())
                                        <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded text-xs font-medium">
                                            ¡Últimas unidades!
                                        </div>
                                    @endif
                                </div>

                                <!-- Información del producto -->
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        <a href="{{ route('shop.show', $product) }}" class="hover:text-red-600 transition-colors">
                                            {{ $product->name }}
                                        </a>
                                    </h3>

                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ Str::limit($product->description, 100) }}
                                    </p>

                                    <div class="flex items-center justify-between">
                                        <div class="text-lg font-bold text-red-600">
                                            {{ number_format($product->getCurrentPrice(), 2) }} BOB
                                        </div>

                                        <form method="POST" action="{{ route('cart.add', $product) }}" class="inline">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 11-4 0v-6m4 0V9a2 2 0 10-4 0v4.01"></path>
                                                </svg>
                                                Agregar
                                            </button>
                                        </form>
                                    </div>

                                    @if($product->stock > 0)
                                        <div class="mt-2 text-xs text-gray-500">
                                            Stock: {{ number_format($product->stock, 0) }} unidades
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginación -->
                    <div class="mt-8">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <!-- No hay productos -->
                    <div class="bg-white rounded-lg shadow-md p-8 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-5.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron productos</h3>
                        <p class="text-gray-600 mb-4">Intenta ajustar tus filtros de búsqueda.</p>
                        <a href="{{ route('shop.index') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md font-medium transition-colors">
                            Ver todos los productos
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-public-layout>