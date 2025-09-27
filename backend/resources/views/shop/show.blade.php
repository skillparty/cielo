<x-public-layout title="{{ $product->name }} - Cielo Carnes">
    <!-- Breadcrumb -->
    <nav class="bg-gray-50 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li><a href="{{ route('shop.index') }}" class="hover:text-red-600">Tienda</a></li>
                @if($product->category)
                    <li>/</li>
                    <li><a href="{{ route('shop.category', $product->category) }}" class="hover:text-red-600">{{ $product->category->name }}</a></li>
                @endif
                <li>/</li>
                <li class="text-gray-900 font-medium">{{ $product->name }}</li>
            </ol>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Imagen del producto -->
            <div class="space-y-4">
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                    @if($product->getFirstMediaUrl('images'))
                        <img src="{{ $product->getFirstMediaUrl('images') }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Galería de imágenes adicionales (si las hay) -->
                @if($product->getMedia('images')->count() > 1)
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($product->getMedia('images') as $index => $media)
                            @if($index > 0)
                                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden cursor-pointer hover:opacity-75 transition-opacity">
                                    <img src="{{ $media->getUrl('thumb') }}"
                                         alt="{{ $product->name }} - Imagen {{ $index + 1 }}"
                                         class="w-full h-full object-cover">
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                <!-- Información adicional -->
                @if($product->is_featured)
                    <div class="inline-flex items-center gap-2 bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        Producto Destacado
                    </div>
                @endif
            </div>

            <!-- Información del producto -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

                    @if($product->category)
                        <p class="text-sm text-gray-600 mb-4">
                            Categoría: <a href="{{ route('shop.category', $product->category) }}" class="text-red-600 hover:text-red-800">{{ $product->category->name }}</a>
                        </p>
                    @endif

                    <div class="flex items-center gap-4 mb-6">
                        <div class="text-3xl font-bold text-red-600">
                            {{ number_format($product->getCurrentPrice(), 2) }} BOB
                        </div>

                        @if($product->stock_quantity !== null)
                            <div class="text-sm {{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                @if($product->stock_quantity > 10)
                                    ✓ En stock
                                @elseif($product->stock_quantity > 0)
                                    ⚠️ ¡Últimas {{ $product->stock_quantity }} unidades!
                                @else
                                    ✗ Agotado
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Descripción -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Descripción</h3>
                    <div class="prose prose-sm text-gray-600">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>

                <!-- Información nutricional (si existe) -->
                @if($product->nutrition_info)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Información Nutricional</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                @if(isset($product->nutrition_info['calories']))
                                    <div class="text-center">
                                        <div class="font-semibold text-gray-900">{{ $product->nutrition_info['calories'] }}</div>
                                        <div class="text-gray-600">Calorías</div>
                                    </div>
                                @endif
                                @if(isset($product->nutrition_info['protein']))
                                    <div class="text-center">
                                        <div class="font-semibold text-gray-900">{{ $product->nutrition_info['protein'] }}g</div>
                                        <div class="text-gray-600">Proteína</div>
                                    </div>
                                @endif
                                @if(isset($product->nutrition_info['fat']))
                                    <div class="text-center">
                                        <div class="font-semibold text-gray-900">{{ $product->nutrition_info['fat'] }}g</div>
                                        <div class="text-gray-600">Grasa</div>
                                    </div>
                                @endif
                                @if(isset($product->nutrition_info['carbs']))
                                    <div class="text-center">
                                        <div class="font-semibold text-gray-900">{{ $product->nutrition_info['carbs'] }}g</div>
                                        <div class="text-gray-600">Carbohidratos</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Agregar al carrito -->
                @if($product->isInStock())
                    <div class="bg-gray-50 rounded-lg p-6">
                        <form method="POST" action="{{ route('cart.add', $product) }}" class="space-y-4">
                            @csrf

                            <div class="flex items-center gap-4">
                                <label for="quantity" class="text-sm font-medium text-gray-700">Cantidad:</label>
                                <div class="flex items-center border border-gray-300 rounded-md">
                                    <button type="button"
                                            onclick="decrementQuantity()"
                                            class="px-3 py-2 text-gray-600 hover:text-gray-800 focus:outline-none">
                                        -
                                    </button>
                                    <input type="number"
                                           id="quantity"
                                           name="quantity"
                                           value="1"
                                           min="1"
                                           max="{{ $product->stock_quantity ?? 99 }}"
                                           class="w-16 text-center border-0 focus:ring-0">
                                    <button type="button"
                                            onclick="incrementQuantity()"
                                            class="px-3 py-2 text-gray-600 hover:text-gray-800 focus:outline-none">
                                        +
                                    </button>
                                </div>
                            </div>

                            <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 11-4 0v-6m4 0V9a2 2 0 10-4 0v4.01"></path>
                                </svg>
                                Agregar al Carrito
                            </button>
                        </form>

                        <div class="mt-4 text-center">
                            <a href="{{ route('cart.index') }}" class="text-sm text-red-600 hover:text-red-800">
                                Ver carrito de compras →
                            </a>
                        </div>
                    </div>
                @else
                    <div class="bg-red-50 border border-red-200 rounded-lg p-6 text-center">
                        <svg class="w-12 h-12 text-red-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-red-800 mb-2">Producto Agotado</h3>
                        <p class="text-red-700 text-sm">Este producto no está disponible actualmente.</p>
                    </div>
                @endif

                <!-- Información adicional -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-900">SKU:</span>
                            <span class="text-gray-600">{{ $product->sku }}</span>
                        </div>

                        @if($product->weight)
                            @if($product->unit_quantity)
                                <div>
                                    <span class="font-medium text-gray-900">Cantidad por unidad:</span>
                                    <span class="text-gray-600">{{ $product->unit_quantity }} {{ $product->unit_type }}</span>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos relacionados -->
        @if($relatedProducts->count() > 0)
            <div class="border-t border-gray-200 pt-12 mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Productos Relacionados</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="aspect-square bg-gray-100">
                                @if($relatedProduct->getFirstMediaUrl('images'))
                                    <img src="{{ $relatedProduct->getFirstMediaUrl('images', 'thumb') }}"
                                         alt="{{ $relatedProduct->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    <a href="{{ route('shop.show', $relatedProduct) }}" class="hover:text-red-600 transition-colors">
                                        {{ $relatedProduct->name }}
                                    </a>
                                </h3>

                                <div class="flex items-center justify-between">
                                    <div class="text-lg font-bold text-red-600">
                                        {{ number_format($relatedProduct->price, 2) }} BOB
                                    </div>

                                    <form method="POST" action="{{ route('cart.add', $relatedProduct) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="text-red-600 hover:text-red-800 p-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        function incrementQuantity() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.getAttribute('max')) || 99;
            const currentValue = parseInt(input.value) || 1;
            if (currentValue < max) {
                input.value = currentValue + 1;
            }
        }

        function decrementQuantity() {
            const input = document.getElementById('quantity');
            const min = parseInt(input.getAttribute('min')) || 1;
            const currentValue = parseInt(input.value) || 1;
            if (currentValue > min) {
                input.value = currentValue - 1;
            }
        }
    </script>
</x-public-layout>