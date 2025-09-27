<div class="flex flex-col h-full bg-white border-r border-gray-200">
    <!-- Logo -->
    <div class="flex items-center h-16 flex-shrink-0 px-4 bg-indigo-600">
        <h2 class="text-xl font-bold text-white">Cielo Admin</h2>
    </div>
    
    <!-- Navigation -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-white space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="@if(request()->routeIs('admin.dashboard*')) bg-indigo-100 border-r-4 border-indigo-500 text-indigo-700 @else text-gray-600 hover:bg-gray-50 hover:text-gray-900 @endif group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="@if(request()->routeIs('admin.dashboard*')) text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v.01L8 5.01z" />
                </svg>
                Dashboard
            </a>

            <!-- Usuarios -->
            <a href="{{ route('admin.users.index') }}" 
               class="@if(request()->routeIs('admin.users*')) bg-indigo-100 border-r-4 border-indigo-500 text-indigo-700 @else text-gray-600 hover:bg-gray-50 hover:text-gray-900 @endif group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="@if(request()->routeIs('admin.users*')) text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                Usuarios
            </a>

            <!-- Productos -->
            <a href="{{ route('admin.products.index') }}" 
               class="@if(request()->routeIs('admin.products*')) bg-indigo-100 border-r-4 border-indigo-500 text-indigo-700 @else text-gray-600 hover:bg-gray-50 hover:text-gray-900 @endif group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="@if(request()->routeIs('admin.products*')) text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Productos
            </a>

            <!-- Categorías -->
            <a href="{{ route('admin.categories.index') }}" 
               class="@if(request()->routeIs('admin.categories*')) bg-indigo-100 border-r-4 border-indigo-500 text-indigo-700 @else text-gray-600 hover:bg-gray-50 hover:text-gray-900 @endif group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="@if(request()->routeIs('admin.categories*')) text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Categorías
            </a>

            <!-- Órdenes -->
            <a href="{{ route('admin.orders.index') }}" 
               class="@if(request()->routeIs('admin.orders*')) bg-indigo-100 border-r-4 border-indigo-500 text-indigo-700 @else text-gray-600 hover:bg-gray-50 hover:text-gray-900 @endif group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="@if(request()->routeIs('admin.orders*')) text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                Órdenes
            </a>

            <!-- Recetas -->
            <a href="{{ route('admin.recipes.index') }}" 
               class="@if(request()->routeIs('admin.recipes*')) bg-indigo-100 border-r-4 border-indigo-500 text-indigo-700 @else text-gray-600 hover:bg-gray-50 hover:text-gray-900 @endif group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="@if(request()->routeIs('admin.recipes*')) text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Recetas
            </a>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-3"></div>

            <!-- Reportes -->
            <div class="px-3 mt-6">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Reportes
                </h3>
            </div>
            
            <a href="#" 
               class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Ventas
            </a>

            <!-- Configuración -->
            <div class="px-3 mt-6">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Configuración
                </h3>
            </div>
            
            <!-- Configuración del Sistema -->
            <a href="{{ route('admin.settings.index') }}" 
               class="@if(request()->routeIs('admin.settings*')) bg-indigo-100 border-r-4 border-indigo-500 text-indigo-700 @else text-gray-600 hover:bg-gray-50 hover:text-gray-900 @endif group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="@if(request()->routeIs('admin.settings*')) text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Configuraciones
            </a>

            <!-- Sistema de Notificaciones -->
            @can('manage system')
            <a href="{{ route('admin.notifications.index') }}" 
               class="@if(request()->routeIs('admin.notifications*')) bg-indigo-100 border-r-4 border-indigo-500 text-indigo-700 @else text-gray-600 hover:bg-gray-50 hover:text-gray-900 @endif group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="@if(request()->routeIs('admin.notifications*')) text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM9.3 9.3a9 9 0 11-6.6 6.6h0M7 13l3 3 7-7" />
                </svg>
                Notificaciones
            </a>
            @endcan

            <!-- Gestión de Roles -->
            @can('manage user roles')
            <a href="{{ route('admin.users.index') }}?tab=roles" 
               class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Roles y Permisos
            </a>
            @endcan
        </nav>
    </div>
</div>