<x-public-layout title="{{ $recipe->title }} - Recetario">
    <!-- Breadcrumb -->
    <nav class="bg-gray-50 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li><a href="{{ route('recipes.index') }}" class="hover:text-orange-600">Recetario</a></li>
                @if($recipe->category)
                    <li>/</li>
                    <li><a href="{{ route('recipes.category', $recipe->category) }}" class="hover:text-orange-600">{{ $recipe->category->name }}</a></li>
                @endif
                <li>/</li>
                <li class="text-gray-900 font-medium">{{ $recipe->title }}</li>
            </ol>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Contenido principal -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Header de la receta -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Imagen -->
                        <div class="md:w-1/3">
                            @if($recipe->getFirstMediaUrl('images'))
                                <img src="{{ $recipe->getFirstMediaUrl('images') }}"
                                     alt="{{ $recipe->title }}"
                                     class="w-full rounded-lg">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-orange-100 to-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-16 h-16 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Información -->
                        <div class="md:w-2/3">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $recipe->title }}</h1>

                            @if($recipe->category)
                                <p class="text-sm text-gray-600 mb-4">
                                    Categoría: <a href="{{ route('recipes.category', $recipe->category) }}" class="text-orange-600 hover:text-orange-800">{{ $recipe->category->name }}</a>
                                </p>
                            @endif

                            <p class="text-gray-600 mb-6">{{ $recipe->summary }}</p>

                            <!-- Metadatos -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-orange-600">{{ $recipe->prep_time_minutes }}</div>
                                    <div class="text-sm text-gray-600">Preparación</div>
                                </div>

                                @if($recipe->cook_time_minutes)
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-orange-600">{{ $recipe->cook_time_minutes }}</div>
                                        <div class="text-sm text-gray-600">Cocción</div>
                                    </div>
                                @endif

                                <div class="text-center">
                                    <div class="text-2xl font-bold text-orange-600">{{ $recipe->servings }}</div>
                                    <div class="text-sm text-gray-600">Porciones</div>
                                </div>

                                <div class="text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if($recipe->difficulty_level == 1) bg-green-100 text-green-800
                                        @elseif($recipe->difficulty_level == 2) bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $recipe->getDifficultyLabel() }}
                                    </span>
                                </div>
                            </div>

                            <!-- Botón de combo -->
                            @if($recipe->combos()->exists())
                                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="font-semibold text-orange-900">¡Combo disponible!</h3>
                                            <p class="text-sm text-orange-700">Agrega todos los productos necesarios al carrito</p>
                                        </div>
                                        <form method="POST" action="{{ route('recipes.add-combo', $recipe) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 11-4 0v-6m4 0V9a2 2 0 10-4 0v4.01"></path>
                                                </svg>
                                                Agregar Combo
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Ingredientes -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Ingredientes</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($recipe->products as $product)
                            <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                @if($product->getFirstMediaUrl('images'))
                                    <img src="{{ $product->getFirstMediaUrl('images', 'thumb') }}"
                                         alt="{{ $product->name }}"
                                         class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif

                                <div class="flex-grow">
                                    <h4 class="font-medium text-gray-900">
                                        <a href="{{ route('shop.show', $product) }}" class="hover:text-orange-600">
                                            {{ $product->name }}
                                        </a>
                                    </h4>
                                    <p class="text-sm text-gray-600">
                                        {{ $product->pivot->quantity }} {{ $product->pivot->unit }}
                                        @if($product->pivot->is_optional)
                                            <span class="text-orange-600">(opcional)</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="text-right">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ number_format($product->getCurrentPrice(), 2) }} BOB
                                    </div>
                                    <form method="POST" action="{{ route('cart.add', $product) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="text-orange-600 hover:text-orange-800 text-sm">
                                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Información nutricional total -->
                    @if($recipe->products->count() > 0)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="font-semibold text-gray-900 mb-3">Información Nutricional (aproximada por porción)</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div class="text-center">
                                    <div class="font-semibold text-gray-900">---</div>
                                    <div class="text-gray-600">Calorías</div>
                                </div>
                                <div class="text-center">
                                    <div class="font-semibold text-gray-900">---</div>
                                    <div class="text-gray-600">Proteína</div>
                                </div>
                                <div class="text-center">
                                    <div class="font-semibold text-gray-900">---</div>
                                    <div class="text-gray-600">Grasa</div>
                                </div>
                                <div class="text-center">
                                    <div class="font-semibold text-gray-900">---</div>
                                    <div class="text-gray-600">Carbohidratos</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Instrucciones -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Instrucciones</h2>

                    @if($recipe->instructions)
                        <div class="prose prose-lg max-w-none">
                            {!! nl2br(e($recipe->instructions)) !!}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-gray-600">Las instrucciones detalladas estarán disponibles próximamente.</p>
                        </div>
                    @endif

                    <!-- Consejos adicionales -->
                    @if($recipe->preparation_tips)
                        <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <h3 class="font-semibold text-blue-900 mb-2">💡 Consejos de preparación</h3>
                            <div class="text-blue-800">
                                {!! nl2br(e($recipe->preparation_tips)) !!}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Información adicional -->
                @if($recipe->video_url)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Video Tutorial</h2>
                        <div class="aspect-video">
                            <iframe src="{{ $recipe->video_url }}"
                                    class="w-full h-full rounded-lg"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Información rápida -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Información Rápida</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tiempo total:</span>
                            <span class="font-medium">{{ $recipe->getTotalTimeMinutes() }} min</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dificultad:</span>
                            <span class="font-medium">{{ $recipe->getDifficultyLabel() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Porciones:</span>
                            <span class="font-medium">{{ $recipe->servings }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Categoría:</span>
                            <span class="font-medium">{{ $recipe->category->name ?? 'General' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Productos destacados -->
                @if($recipe->products->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Productos Necesarios</h3>
                        <div class="space-y-3">
                            @foreach($recipe->products->take(5) as $product)
                                <div class="flex items-center gap-3">
                                    @if($product->getFirstMediaUrl('images'))
                                        <img src="{{ $product->getFirstMediaUrl('images', 'thumb') }}"
                                             alt="{{ $product->name }}"
                                             class="w-8 h-8 rounded object-cover">
                                    @else
                                        <div class="w-8 h-8 bg-gray-200 rounded flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-grow min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            <a href="{{ route('shop.show', $product) }}" class="hover:text-orange-600">
                                                {{ $product->name }}
                                            </a>
                                        </p>
                                        <p class="text-xs text-gray-600">{{ $product->pivot->quantity }} {{ $product->pivot->unit }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($recipe->products->count() > 5)
                            <p class="text-xs text-gray-500 mt-3">
                                Y {{ $recipe->products->count() - 5 }} productos más...
                            </p>
                        @endif
                    </div>
                @endif

                <!-- Recetas relacionadas -->
                @if($relatedRecipes->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Recetas Relacionadas</h3>
                        <div class="space-y-3">
                            @foreach($relatedRecipes as $relatedRecipe)
                                <div class="flex gap-3">
                                    @if($relatedRecipe->getFirstMediaUrl('images'))
                                        <img src="{{ $relatedRecipe->getFirstMediaUrl('images', 'thumb') }}"
                                             alt="{{ $relatedRecipe->title }}"
                                             class="w-12 h-12 rounded object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-grow min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900">
                                            <a href="{{ route('recipes.show', $relatedRecipe) }}" class="hover:text-orange-600">
                                                {{ $relatedRecipe->title }}
                                            </a>
                                        </h4>
                                        <p class="text-xs text-gray-600">{{ $relatedRecipe->prep_time_minutes }} min • {{ $relatedRecipe->getDifficultyLabel() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-public-layout>