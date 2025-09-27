<x-public-layout title="Nosotros">
    <!-- Hero Section -->
    @if($heroContent)
    <section class="relative bg-gradient-to-r from-red-600 to-red-800 text-white">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        @if($heroContent->getFirstMediaUrl('images'))
            <div class="absolute inset-0">
                <img src="{{ $heroContent->getFirstMediaUrl('images') }}" 
                     alt="Cielo Carnes" 
                     class="w-full h-full object-cover">
            </div>
            <div class="absolute inset-0 bg-red-900 opacity-60"></div>
        @endif
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    {{ $heroContent->title ?? 'Cielo Carnes' }}
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                    {{ $heroContent->content ?? 'Especialistas en carnes y fiambres de cerdo de la más alta calidad' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#historia" class="bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Conoce Nuestra Historia
                    </a>
                    <a href="#ubicacion" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-red-600 transition-colors">
                        Visítanos
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Historia Section -->
    @if($historyContent)
    <section id="historia" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        {{ $historyContent->title ?? 'Nuestra Historia' }}
                    </h2>
                    <div class="prose prose-lg text-gray-600">
                        {!! nl2br(e($historyContent->content ?? 'Desde hace más de 20 años, Cielo Carnes ha sido sinónimo de calidad y tradición en el sector cárnico. Comenzamos como un pequeño negocio familiar y hemos crecido hasta convertirnos en una de las empresas más reconocidas en carnes y fiambres de cerdo en Bolivia.')) !!}
                    </div>
                    
                    @if($historyContent->metadata && isset($historyContent->metadata['founded_year']))
                    <div class="mt-8 grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-red-600">{{ $historyContent->metadata['founded_year'] }}</div>
                            <div class="text-sm text-gray-500">Año de Fundación</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-red-600">{{ date('Y') - $historyContent->metadata['founded_year'] }}+</div>
                            <div class="text-sm text-gray-500">Años de Experiencia</div>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="relative">
                    @if($historyContent->getFirstMediaUrl('images'))
                        <img src="{{ $historyContent->getFirstMediaUrl('images') }}" 
                             alt="Historia de Cielo Carnes" 
                             class="rounded-lg shadow-xl">
                    @else
                        <div class="bg-gray-200 rounded-lg shadow-xl h-96 flex items-center justify-center">
                            <div class="text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p>Imagen de la historia</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Valores Section -->
    @if($valuesContent)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ $valuesContent->title ?? 'Nuestros Valores' }}
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    {{ $valuesContent->subtitle ?? 'Los principios que guían nuestro trabajo diario' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Calidad -->
                <div class="text-center bg-white p-8 rounded-lg shadow-md">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Calidad Premium</h3>
                    <p class="text-gray-600">Seleccionamos cuidadosamente cada producto para garantizar la máxima calidad y frescura.</p>
                </div>

                <!-- Tradición -->
                <div class="text-center bg-white p-8 rounded-lg shadow-md">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Tradición Familiar</h3>
                    <p class="text-gray-600">Más de 20 años de experiencia familiar en el sector cárnico boliviano.</p>
                </div>

                <!-- Servicio -->
                <div class="text-center bg-white p-8 rounded-lg shadow-md">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Servicio Excepcional</h3>
                    <p class="text-gray-600">Atención personalizada y compromiso total con la satisfacción del cliente.</p>
                </div>
            </div>

            @if($valuesContent->content)
            <div class="mt-12 text-center">
                <div class="prose prose-lg mx-auto text-gray-600">
                    {!! nl2br(e($valuesContent->content)) !!}
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    <!-- Galería Section -->
    @if($galleryImages->count() > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nuestra Galería</h2>
                <p class="text-xl text-gray-600">Conoce nuestras instalaciones y productos</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{ selectedImage: null }">
                @foreach($galleryImages as $image)
                    @if($image->getFirstMediaUrl('images'))
                    <div class="relative group cursor-pointer" @click="selectedImage = '{{ $image->getFirstMediaUrl('images') }}'">
                        <img src="{{ $image->getFirstMediaUrl('images', 'thumb') }}" 
                             alt="{{ $image->title }}" 
                             class="w-full h-64 object-cover rounded-lg shadow-md group-hover:shadow-xl transition-shadow">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        @if($image->title)
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4 rounded-b-lg">
                            <p class="text-white text-sm font-medium">{{ $image->title }}</p>
                        </div>
                        @endif
                    </div>
                    @endif
                @endforeach

                <!-- Modal para imagen ampliada -->
                <div x-show="selectedImage" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4"
                     @click="selectedImage = null"
                     style="display: none;">
                    <img :src="selectedImage" class="max-w-full max-h-full object-contain rounded-lg">
                    <button @click="selectedImage = null" class="absolute top-4 right-4 text-white hover:text-gray-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Ubicación Section -->
    @if($locationContent)
    <section id="ubicacion" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ $locationContent->title ?? 'Nuestra Ubicación' }}
                </h2>
                <p class="text-xl text-gray-600">
                    {{ $locationContent->subtitle ?? 'Visítanos en nuestras instalaciones' }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Información de contacto -->
                <div>
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Información de Contacto</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-600 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">Dirección</p>
                                    <p class="text-gray-600">
                                        {{ $locationContent->metadata['address'] ?? 'Av. Principal 123, La Paz, Bolivia' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-600 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">Teléfono</p>
                                    <p class="text-gray-600">+591 2 123-4567</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-600 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">Email</p>
                                    <p class="text-gray-600">info@cielocarnes.com</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-600 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">Horarios de Atención</p>
                                    <p class="text-gray-600">
                                        Lunes a Viernes: 8:00 - 18:00<br>
                                        Sábados: 8:00 - 14:00<br>
                                        Domingos: Cerrado
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($locationContent->content)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="prose text-gray-600">
                                {!! nl2br(e($locationContent->content)) !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Mapa -->
                <div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <div id="map" class="w-full h-96 rounded-lg"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script del mapa -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Coordenadas por defecto (La Paz, Bolivia)
            const lat = {{ $locationContent->metadata['latitude'] ?? -16.5000 }};
            const lng = {{ $locationContent->metadata['longitude'] ?? -68.1193 }};
            
            // Inicializar el mapa
            const map = L.map('map').setView([lat, lng], 15);
            
            // Agregar tiles de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            
            // Agregar marcador
            const marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup('<b>Cielo Carnes</b><br>{{ $locationContent->metadata['address'] ?? 'Av. Principal 123, La Paz, Bolivia' }}');
        });
    </script>
    @endif
</x-public-layout>