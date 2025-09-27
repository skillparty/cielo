<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Cielo Carnes' }} - Carnes y Fiambres de Calidad</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
          crossorigin=""/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Cart counter script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();

            // Update cart count after form submissions
            document.addEventListener('submit', function(e) {
                if (e.target.action.includes('/carrito/agregar')) {
                    setTimeout(updateCartCount, 500);
                }
            });
        });

        function updateCartCount() {
            fetch('/carrito/contar')
                .then(response => response.json())
                .then(data => {
                    const cartCount = document.getElementById('cart-count');
                    if (data.count > 0) {
                        cartCount.textContent = data.count > 99 ? '99+' : data.count;
                        cartCount.classList.remove('hidden');
                    } else {
                        cartCount.classList.add('hidden');
                    }
                })
                .catch(error => console.error('Error updating cart count:', error));
        }
    </script>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('about.index') }}" class="flex items-center">
                        <img src="/images/logo.png" alt="Cielo Carnes" class="h-10 w-auto" onerror="this.style.display='none'">
                        <span class="ml-2 text-xl font-bold text-red-600">Cielo Carnes</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('about.index') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors">
                        Nosotros
                    </a>
                    <a href="{{ route('shop.index') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors">
                        Tienda
                    </a>
                    <a href="{{ route('recipes.index') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors">
                        Recetario
                    </a>
                    <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors">
                        Contacto
                    </a>
                </nav>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-sm text-gray-700 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ Auth::user()->name }}
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mi Perfil</a>
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Registrarse
                        </a>
                    @endauth

                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-red-600 transition-colors relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 11-4 0v-6m4 0V9a2 2 0 10-4 0v4.01"></path>
                        </svg>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">
                            0
                        </span>
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-700 hover:text-red-600" x-data="{ open: false }" @click="open = !open">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-lg font-semibold mb-4">Cielo Carnes</h3>
                    <p class="text-gray-300 mb-4">
                        Especialistas en carnes y fiambres de cerdo de la más alta calidad. 
                        Tradición familiar desde hace más de 20 años.
                    </p>
                    <div class="space-y-2 text-sm text-gray-300">
                        <p><strong>Email:</strong> info@cielocarnes.com</p>
                        <p><strong>Teléfono:</strong> +591 2 123-4567</p>
                        <p><strong>Dirección:</strong> Av. Principal 123, La Paz, Bolivia</p>
                    </div>
                </div>

                <!-- Customer Service -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Atención al Cliente</h3>
                    <div class="space-y-2 text-sm text-gray-300">
                        <p><strong>Email:</strong> soporte@cielocarnes.com</p>
                        <p><strong>Teléfono:</strong> +591 2 765-4321</p>
                        <p><strong>Horarios:</strong> Lun-Vie 8:00-18:00</p>
                    </div>
                </div>

                <!-- Legal -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Legal</h3>
                    <div class="space-y-2">
                        <a href="#" class="block text-sm text-gray-300 hover:text-white transition-colors">
                            Políticas y Condiciones
                        </a>
                        <a href="#" class="block text-sm text-gray-300 hover:text-white transition-colors">
                            Privacidad
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-sm text-gray-400">
                    © {{ date('Y') }} Cielo Carnes. Todos los derechos reservados.
                </p>
                <p class="text-xs text-gray-500 mt-2">
                    Desarrollado con Laravel, Tailwind CSS y Alpine.js
                </p>
            </div>
        </div>
    </footer>
</body>
</html>