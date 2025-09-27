<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetario - Cielo Carnes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <h1 class="text-2xl font-bold text-gray-900">Cielo Carnes - Recetario</h1>
                    <nav class="space-x-4">
                        <a href="/" class="text-gray-600 hover:text-gray-900">Inicio</a>
                        <a href="/nosotros" class="text-gray-600 hover:text-gray-900">Nosotros</a>
                        <a href="/tienda" class="text-gray-600 hover:text-gray-900">Tienda</a>
                        <a href="/recetario" class="text-red-600 font-medium">Recetario</a>
                    </nav>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <h1 class="text-3xl font-bold text-gray-900 mb-8">Recetario de Cielo Carnes</h1>

                <!-- Filtros -->
                <div class="bg-white p-4 rounded-lg shadow mb-6">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500"
                                   placeholder="Nombre de la receta...">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                            <select name="category" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                                <option value="">Todas las categorías</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dificultad</label>
                            <select name="difficulty" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                                <option value="">Todas</option>
                                <option value="Fácil" {{ request('difficulty') == 'Fácil' ? 'selected' : '' }}>Fácil</option>
                                <option value="Media" {{ request('difficulty') == 'Media' ? 'selected' : '' }}>Media</option>
                                <option value="Difícil" {{ request('difficulty') == 'Difícil' ? 'selected' : '' }}>Difícil</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tiempo máximo</label>
                            <select name="max_time" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                                <option value="">Sin límite</option>
                                <option value="15" {{ request('max_time') == '15' ? 'selected' : '' }}>15 min</option>
                                <option value="30" {{ request('max_time') == '30' ? 'selected' : '' }}>30 min</option>
                                <option value="60" {{ request('max_time') == '60' ? 'selected' : '' }}>1 hora</option>
                                <option value="120" {{ request('max_time') == '120' ? 'selected' : '' }}>2 horas</option>
                            </select>
                        </div>

                        <div class="md:col-span-4 flex gap-2">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-medium">
                                Filtrar
                            </button>
                            <a href="{{ route('recipes.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md font-medium">
                                Limpiar filtros
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Resultados -->
                <div class="mb-4">
                    <p class="text-gray-600">
                        Mostrando {{ $recipes->count() }} de {{ $recipes->total() }} recetas
                    </p>
                </div>

                <!-- Grid de recetas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($recipes as $recipe)
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            <div class="aspect-video bg-gray-200 relative">
                                @if($recipe->getFirstMediaUrl('images'))
                                    <img src="{{ $recipe->getFirstMediaUrl('images', 'thumb') }}"
                                         alt="{{ $recipe->title }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    <a href="{{ route('recipes.show', $recipe) }}" class="hover:text-red-600">
                                        {{ $recipe->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    {{ $recipe->summary }}
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                    <span>{{ $recipe->prep_time_minutes }} min</span>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        @if($recipe->difficulty_level == 1) bg-green-100 text-green-800
                                        @elseif($recipe->difficulty_level == 2) bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $recipe->getDifficultyLabel() }}
                                    </span>
                                </div>

                                @if($recipe->category)
                                    <p class="text-xs text-gray-500 mb-3">
                                        <a href="{{ route('recipes.category', $recipe->category) }}" class="hover:text-red-600">
                                            {{ $recipe->category->name }}
                                        </a>
                                    </p>
                                @endif

                                <a href="{{ route('recipes.show', $recipe) }}"
                                   class="block w-full bg-red-600 hover:bg-red-700 text-white text-center py-2 px-4 rounded-md font-medium transition-colors">
                                    Ver Receta
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron recetas</h3>
                            <p class="text-gray-600">Intenta cambiar los filtros de búsqueda.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Paginación -->
                @if($recipes->hasPages())
                    <div class="mt-8">
                        {{ $recipes->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>