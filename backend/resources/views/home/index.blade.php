<x-public-layout title="Inicio - Cielo Carnes">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-red-600 to-red-800 text-white overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        
        <!-- Hero Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hero-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="2" fill="white" opacity="0.3"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#hero-pattern)"/>
            </svg>
        </div>

        @if($heroContent && $heroContent->getFirstMediaUrl('images'))
            <div class="absolute inset-0">
                <img src="{{ $heroContent->getFirstMediaUrl('images') }}" 
                     alt="Cielo Carnes" 
                     class="w-full h-full object-cover">
            </div>
            <div class="absolute inset-0 bg-red-900 opacity-70"></div>
        @endif
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    {{ $heroContent->title ?? 'Cielo Carnes' }}
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-4xl mx-auto leading-relaxed">
                    {{ $heroContent->content ?? 'Especialistas en carnes y fiambres de cerdo de la más alta calidad. Tradición familiar desde hace más de 20 años.' }}
                </p>
                
                <!-- Statistics Bar -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold mb-1">{{ $stats['years_experience'] }}+</div>
                        <div class="text-sm md:text-base opacity-90">Años de Experiencia</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold mb-1">{{ $stats['products_count'] }}+</div>
                        <div class="text-sm md:text-base opacity-90">Productos</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold mb-1">{{ $stats['recipes_count'] }}+</div>
                        <div class="text-sm md:text-base opacity-90">Recetas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold mb-1">100%</div>
                        <div class="text-sm md:text-base opacity-90">Calidad</div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('shop.index') }}" 
                       class="bg-white text-red-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Explorar Tienda
                        </span>
                    </a>
                    <a href="{{ route('about.index') }}" 
                       class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-red-600 transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Nuestra Historia
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">¿Qué Ofrecemos?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Descubre todo lo que tenemos para ti en Cielo Carnes</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Nosotros -->
                <div class="group text-center p-8 rounded-xl bg-gray-50 hover:bg-red-50 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="bg-red-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-red-200 transition-colors group-hover:scale-110 transform duration-300">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Nosotros</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Conoce nuestra historia, misión y los valores que nos han llevado a ser líderes en calidad.</p>
                    <a href="{{ route('about.index') }}" class="inline-flex items-center text-red-600 hover:text-red-800 font-semibold group-hover:underline">
                        Conocer más 
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Tienda -->
                <div class="group text-center p-8 rounded-xl bg-gray-50 hover:bg-red-50 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="bg-red-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-red-200 transition-colors group-hover:scale-110 transform duration-300">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tienda</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Explora nuestro catálogo completo de carnes y fiambres de cerdo premium.</p>
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center text-red-600 hover:text-red-800 font-semibold group-hover:underline">
                        Ir a tienda 
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Recetario -->
                <div class="group text-center p-8 rounded-xl bg-gray-50 hover:bg-red-50 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="bg-red-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-red-200 transition-colors group-hover:scale-110 transform duration-300">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Recetario</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Descubre deliciosas recetas y aprende a preparar platillos increíbles con nuestros productos.</p>
                    <a href="{{ route('recipes.index') }}" class="inline-flex items-center text-red-600 hover:text-red-800 font-semibold group-hover:underline">
                        Ver recetas 
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Contacto -->
                <div class="group text-center p-8 rounded-xl bg-gray-50 hover:bg-red-50 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="bg-red-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-red-200 transition-colors group-hover:scale-110 transform duration-300">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Contacto</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">¿Tienes preguntas? Contáctanos y te ayudaremos con gusto.</p>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center text-red-600 hover:text-red-800 font-semibold group-hover:underline">
                        Contactar 
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    @if($featuredProducts->count() > 0)
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Productos Destacados</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">La mejor selección de carnes y fiambres de cerdo</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($featuredProducts as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                    <div class="relative h-64 overflow-hidden">
                        @if($product->getFirstMediaUrl('images'))
                            <img src="{{ $product->getFirstMediaUrl('images') }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center">
                                <svg class="w-20 h-20 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            @if($product->promo_price && $product->promo_price < $product->base_price)
                                <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">Oferta</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="mb-2">
                            @if($product->category)
                                <span class="text-red-600 text-sm font-medium">{{ $product->category->name }}</span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-red-600 transition-colors">{{ $product->name }}</h3>
                        @if($product->subtitle)
                            <p class="text-gray-600 mb-4">{{ $product->subtitle }}</p>
                        @endif
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                @if($product->promo_price && $product->promo_price < $product->base_price)
                                    <span class="text-2xl font-bold text-red-600">${{ number_format($product->promo_price, 2) }}</span>
                                    <span class="text-lg text-gray-500 line-through">${{ number_format($product->base_price, 2) }}</span>
                                @else
                                    <span class="text-2xl font-bold text-gray-900">${{ number_format($product->base_price, 2) }}</span>
                                @endif
                            </div>
                            <a href="{{ route('shop.show', $product) }}" 
                               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors transform hover:scale-105">
                                Ver Producto
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('shop.index') }}" 
                   class="inline-block bg-red-600 hover:bg-red-700 text-white px-12 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Ver Todo el Catálogo
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Popular Recipes Section -->
    @if($popularRecipes->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Recetas Populares</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Inspírate con nuestras recetas más deliciosas</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                @foreach($popularRecipes as $recipe)
                <div class="group">
                    <div class="relative h-64 rounded-2xl overflow-hidden mb-6 shadow-lg">
                        @if($recipe->getFirstMediaUrl('images'))
                            <img src="{{ $recipe->getFirstMediaUrl('images') }}" 
                                 alt="{{ $recipe->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
                                <svg class="w-20 h-20 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex items-center space-x-4 text-sm">
                                @if($recipe->prep_time)
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $recipe->prep_time }} min
                                    </span>
                                @endif
                                @if($recipe->difficulty)
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                        {{ ucfirst($recipe->difficulty) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        @if($recipe->category)
                            <span class="text-orange-600 text-sm font-medium">{{ $recipe->category->name }}</span>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">{{ $recipe->title }}</h3>
                    @if($recipe->description)
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $recipe->description }}</p>
                    @endif
                    <a href="{{ route('recipes.show', $recipe) }}" 
                       class="inline-flex items-center text-orange-600 hover:text-orange-800 font-semibold group-hover:underline">
                        Ver Receta 
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('recipes.index') }}" 
                   class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-12 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Ver Todas las Recetas
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Categories Section -->
    @if($mainCategories->count() > 0)
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Nuestras Categorías</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Explora nuestras diferentes líneas de productos</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($mainCategories as $category)
                <a href="{{ route('shop.category', $category) }}" 
                   class="group block p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-red-200 transition-colors group-hover:scale-110 transform duration-300">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-red-600 transition-colors">{{ $category->name }}</h3>
                    @if($category->description)
                        <p class="text-gray-600 text-sm">{{ $category->description }}</p>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-red-600 to-red-800 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="cta-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="1" fill="white" opacity="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#cta-pattern)"/>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">¿Listo para Descubrir la Calidad?</h2>
            <p class="text-xl md:text-2xl mb-10 max-w-3xl mx-auto opacity-90">
                Únete a miles de clientes satisfechos que han elegido la excelencia de Cielo Carnes
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('shop.index') }}" 
                   class="bg-white text-red-600 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Ir a la Tienda
                    </span>
                </a>
                <a href="{{ route('contact.index') }}" 
                   class="border-2 border-white text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-red-600 transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Contáctanos
                    </span>
                </a>
            </div>
        </div>
    </section>
</x-public-layout>