<x-public-layout title="Pedido Confirmado - Cielo Carnes">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">¡Pedido Confirmado!</h1>
                <p class="text-xl text-green-100">Tu pedido ha sido procesado exitosamente</p>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <!-- Mensaje de confirmación -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-2">Gracias por tu compra</h2>
                <p class="text-gray-600">
                    Hemos recibido tu pedido y estamos preparándolo para el envío.
                    Recibirás actualizaciones por email sobre el estado de tu entrega.
                </p>
            </div>

            <!-- Información del pedido -->
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Detalles del Pedido</h3>

                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Información de Envío</h4>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p><strong>Dirección:</strong> [Dirección del pedido]</p>
                                <p><strong>Ciudad:</strong> [Ciudad del pedido]</p>
                                <p><strong>Teléfono:</strong> [Teléfono del pedido]</p>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Información de Pago</h4>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p><strong>Método:</strong> [Método de pago seleccionado]</p>
                                <p><strong>Estado:</strong> <span class="text-green-600 font-medium">Pendiente de procesamiento</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Próximos pasos -->
            <div class="border-t border-gray-200 pt-8 mt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">¿Qué sucede ahora?</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-2">1. Procesamiento</h4>
                        <p class="text-sm text-gray-600">Estamos preparando tu pedido con los mejores productos</p>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-2">2. Envío</h4>
                        <p class="text-sm text-gray-600">Tu pedido será entregado en 2-4 horas en el área metropolitana</p>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-2">3. Notificaciones</h4>
                        <p class="text-sm text-gray-600">Recibirás actualizaciones por email sobre tu entrega</p>
                    </div>
                </div>
            </div>

            <!-- Información de contacto -->
            <div class="border-t border-gray-200 pt-8 mt-8">
                <div class="bg-blue-50 rounded-lg p-6">
                    <div class="flex items-start gap-4">
                        <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-blue-900 mb-2">¿Necesitas ayuda?</h4>
                            <p class="text-blue-800 text-sm mb-3">
                                Si tienes alguna pregunta sobre tu pedido, no dudes en contactarnos.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="tel:+59121234567" class="text-blue-600 hover:text-blue-800 font-medium">
                                    📞 +591 2 123-4567
                                </a>
                                <a href="mailto:soporte@cielocarnes.com" class="text-blue-600 hover:text-blue-800 font-medium">
                                    ✉️ soporte@cielocarnes.com
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones -->
            <div class="border-t border-gray-200 pt-8 mt-8">
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('shop.index') }}"
                       class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Continuar Comprando
                    </a>

                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center gap-2 border border-gray-300 text-gray-700 hover:bg-gray-50 px-6 py-3 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Ver Mis Pedidos
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>