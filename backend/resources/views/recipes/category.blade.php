<x-public-layout title="Recetas {{ $category->name }}">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-orange-600 to-red-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Recetas de {{ $category->name }}</h1>
                @if($category->description)
                    <p class="text-xl md:text-2xl mb-8">{{ $category->description }}</p>
                @else
                    <p class="text-xl md:text-2xl mb-8">Descubre deliciosas recetas de {{ strtolower($category->name) }}</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <nav class="bg-gray-50 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li><a href="{{ route('recipes.index') }}" class="hover:text-orange-600">Recetario</a></li>
                <li>/</li>
                <li class="text-gray-900 font-medium">{{ $category->name }}</li>
            </ol>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar con filtros -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filtros</h3>

                    <!-- Búsqueda -->
                    <form method="GET" action="{{ route('recipes.category', $category) }}" class="mb-6">
                        <div class="relative">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Buscar en {{ $category->name }}..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </form>

                    <!-- Categorías relacionadas -->
                    @if($category->parent)
                        <!-- Subcategorías del padre -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-3">Otras categorías</h4>
                            <div class="space-y-2">
                                <a href="{{ route('recipes.category', $category->parent) }}"
                                   class="block px-3 py-2 text-sm text-gray-600 hover:text-orange-600">
                                    ← Volver a {{ $category->parent->name }}
                                </a>
                                @foreach($category->parent->children as $sibling)
                                    <a href="{{ route('recipes.category', $sibling) }}"
                                       class="block px-3 py-2 text-sm {{ $sibling->id == $category->id ? 'bg-orange-100 text-orange-700 rounded-md' : 'text-gray-600 hover:text-orange-600' }}">
                                        {{ $sibling->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Subcategorías -->
                        @if($category->children->count() > 0)
                            <div class="mb-6">
                                <h4 class="font-medium text-gray-900 mb-3">Subcategorías</h4>
                                <div class="space-y-2">
                                    @foreach($category->children as $subcategory)
                                        <a href="{{ route('recipes.category', $subcategory) }}"
                                           class="block px-3 py-2 text-sm text-gray-600 hover:text-orange-600">
                                            {{ $subcategory->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Dificultad -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Dificultad</h4>
                        <div class="space-y-2">
                            @foreach(['Fácil', 'Media', 'Difícil'] as $difficulty)
                                <label class="flex items-center">
                                    <input type="checkbox"
                                           name="difficulty[]"
                                           value="{{ $difficulty }}"
                                           {{ in_array($difficulty, request('difficulty', [])) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                                    <span class="ml-2 text-sm text-gray-600">{{ $difficulty }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tiempo de preparación -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Tiempo máximo</h4>
                        <select name="max_time"
                                form="filters-form"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                            <option value="">Sin límite</option>
                            <option value="15" {{ request('max_time') == '15' ? 'selected' : '' }}>15 minutos</option>
                            <option value="30" {{ request('max_time') == '30' ? 'selected' : '' }}>30 minutos</option>
                            <option value="60" {{ request('max_time') == '60' ? 'selected' : '' }}>1 hora</option>
                            <option value="120" {{ request('max_time') == '120' ? 'selected' : '' }}>2 horas</option>
                        </select>
                    </div>

                    <!-- Botón aplicar filtros -->
                    <button type="submit"
                            form="filters-form"
                            class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
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
                            Mostrando {{ $recipes->firstItem() ?? 0 }} - {{ $recipes->lastItem() ?? 0 }} de {{ $recipes->total() }} recetas
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600">Ordenar por:</span>
                            <select name="sort"
                                    form="filters-form"
                                    class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:ring-orange-500 focus:border-orange-500">
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                                <option value="preparation_time" {{ request('sort') == 'preparation_time' ? 'selected' : '' }}>Tiempo</option>
                                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Más recientes</option>
                            </select>

                            <select name="direction"
                                    form="filters-form"
                                    class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:ring-orange-500 focus:border-orange-500">
                                <option value="asc" {{ request('direction', 'asc') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descendente</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Formulario oculto para filtros -->
                <form id="filters-form" method="GET" action="{{ route('recipes.category', $category) }}" class="hidden">
                    @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                    @if(request('difficulty'))@foreach(request('difficulty') as $diff)<input type="hidden" name="difficulty[]" value="{{ $diff }}">@endforeach@endif
                    @if(request('max_time'))<input type="hidden" name="max_time" value="{{ request('max_time') }}">@endif
                </form>

                <!-- Grid de recetas -->
                @if($recipes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($recipes as $recipe)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                <!-- Imagen de la receta -->
                                <div class="relative">
                                    @if($recipe->getFirstMediaUrl('images'))
                                        <img src="{{ $recipe->getFirstMediaUrl('images', 'thumb') }}"
                                             alt="{{ $recipe->name }}"
                                             class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-orange-100 to-red-100 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Badge de dificultad -->
                                    <div class="absolute top-2 left-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($recipe->difficulty_level == 1) bg-green-100 text-green-800
                                            @elseif($recipe->difficulty_level == 2) bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $recipe->getDifficultyLabel() }}
                                        </span>
                                    </div>

                                    <!-- Tiempo de preparación -->
                                    @if($recipe->prep_time_minutes)
                                        <div class="absolute top-2 right-2 bg-black bg-opacity-75 text-white px-2 py-1 rounded text-xs font-medium">
                                            {{ $recipe->prep_time_minutes }} min
                                        </div>
                                    @endif
                                </div>

                                <!-- Información de la receta -->
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        <a href="{{ route('recipes.show', $recipe) }}" class="hover:text-orange-600 transition-colors">
                                            {{ $recipe->title }}
                                        </a>
                                    </h3>

                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ Str::limit($recipe->summary, 100) }}
                                    </p>

                                    <!-- Información adicional -->
                                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                        <span>👥 {{ $recipe->servings }} porciones</span>
                                        @if($recipe->cook_time_minutes)
                                            <span>🔥 {{ $recipe->cook_time_minutes }} min</span>
                                        @endif
                                    </div>

                                    <!-- Acciones -->
                                    <div class="flex gap-2">
                                        <a href="{{ route('recipes.show', $recipe) }}"
                                           class="flex-1 bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md text-sm font-medium text-center transition-colors">
                                            Ver Receta
                                        </a>

                                        @if($recipe->combos()->exists())
                                            <form method="POST" action="{{ route('recipes.add-combo', $recipe) }}" class="inline">
                                                @csrf
                                                <button type="submit"
                                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 11-4 0v-6m4 0V9a2 2 0 10-4 0v4.01"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginación -->
                    <div class="mt-8">
                        {{ $recipes->appends(request()->query())->links() }}
                    </div>
                @else
                    <!-- No hay recetas -->
                    <div class="bg-white rounded-lg shadow-md p-8 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron recetas</h3>
                        <p class="text-gray-600 mb-4">Intenta ajustar tus filtros de búsqueda o explora otras categorías.</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('recipes.category', $category) }}" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-md font-medium transition-colors">
                                Limpiar filtros
                            </a>
                            <a href="{{ route('recipes.index') }}" class="border border-gray-300 text-gray-700 hover:bg-gray-50 px-6 py-2 rounded-md font-medium transition-colors">
                                Ver todas las categorías
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-public-layout>