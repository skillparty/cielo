<x-public-layout title="Contacto">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
                <!-- Hero Section -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">Contáctanos</h1>
                    <p class="text-xl text-gray-600">Estamos aquí para ayudarte. Envíanos tu consulta y te responderemos pronto.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Formulario de contacto -->
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Envíanos un mensaje</h2>

                        @if(session('success'))
                            <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="ml-3">
                                        <p class="text-sm text-green-800">{{ session('success') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nombre completo *
                                    </label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('name') border-red-500 @enderror">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Correo electrónico *
                                    </label>
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        Teléfono *
                                    </label>
                                    <input type="tel"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           required
                                           placeholder="+591 70000000"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('phone') border-red-500 @enderror">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                        Asunto *
                                    </label>
                                    <select id="subject"
                                            name="subject"
                                            required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('subject') border-red-500 @enderror">
                                        <option value="">Selecciona un asunto</option>
                                        <option value="Consulta general" {{ old('subject') == 'Consulta general' ? 'selected' : '' }}>Consulta general</option>
                                        <option value="Información de productos" {{ old('subject') == 'Información de productos' ? 'selected' : '' }}>Información de productos</option>
                                        <option value="Pedidos y entregas" {{ old('subject') == 'Pedidos y entregas' ? 'selected' : '' }}>Pedidos y entregas</option>
                                        <option value="Problemas con pagos" {{ old('subject') == 'Problemas con pagos' ? 'selected' : '' }}>Problemas con pagos</option>
                                        <option value="Sugerencias" {{ old('subject') == 'Sugerencias' ? 'selected' : '' }}>Sugerencias</option>
                                        <option value="Reclamos" {{ old('subject') == 'Reclamos' ? 'selected' : '' }}>Reclamos</option>
                                        <option value="Otro" {{ old('subject') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('subject')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                    Mensaje *
                                </label>
                                <textarea id="message"
                                          name="message"
                                          rows="6"
                                          required
                                          placeholder="Escribe tu mensaje aquí..."
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Máximo 2000 caracteres</p>
                            </div>

                            <div>
                                <button type="submit"
                                        class="w-full bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-md font-medium transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Enviar Mensaje
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Información de contacto -->
                    <div class="space-y-8">
                        <!-- Información principal -->
                        <div class="bg-white rounded-lg shadow-md p-8">
                            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Información de Contacto</h2>

                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <div>
                                        <h3 class="font-medium text-gray-900">Dirección</h3>
                                        <p class="text-gray-600">Av. Principal 123, La Paz, Bolivia</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <div>
                                        <h3 class="font-medium text-gray-900">Teléfonos</h3>
                                        <p class="text-gray-600">
                                            <strong>Principal:</strong> +591 2 123-4567<br>
                                            <strong>Soporte:</strong> +591 2 765-4321
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <h3 class="font-medium text-gray-900">Correos electrónicos</h3>
                                        <p class="text-gray-600">
                                            <strong>General:</strong> info@cielocarnes.com<br>
                                            <strong>Soporte:</strong> soporte@cielocarnes.com
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-red-600 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <h3 class="font-medium text-gray-900">Horarios de Atención</h3>
                                        <p class="text-gray-600">
                                            <strong>Lunes a Viernes:</strong> 8:00 - 18:00<br>
                                            <strong>Sábados:</strong> 8:00 - 14:00<br>
                                            <strong>Domingos:</strong> Cerrado
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Redes sociales -->
                        <div class="bg-white rounded-lg shadow-md p-8">
                            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Síguenos</h2>
                            <div class="flex space-x-4">
                                <a href="#" class="text-blue-600 hover:text-blue-800">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-blue-700 hover:text-blue-900">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-pink-600 hover:text-pink-800">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24c6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-red-600 hover:text-red-800">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preguntas Frecuentes -->
                @if($faqs->count() > 0)
                    <div class="mt-16">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">Preguntas Frecuentes</h2>
                            <p class="text-xl text-gray-600">Encuentra respuestas a las consultas más comunes</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-md">
                            @foreach($faqs as $category => $categoryFaqs)
                                <div class="border-b border-gray-200 last:border-b-0">
                                    <div class="p-6">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $category }}</h3>
                                        <div class="space-y-4" x-data="{ openFaq: null }">
                                            @foreach($categoryFaqs as $index => $faq)
                                                <div class="border border-gray-200 rounded-lg">
                                                    <button @click="openFaq = openFaq === {{ $loop->parent->index }}_{{ $index }} ? null : {{ $loop->parent->index }}_{{ $index }}"
                                                            class="w-full px-4 py-3 text-left flex items-center justify-between hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                                                        <span class="font-medium text-gray-900">{{ $faq->question }}</span>
                                                        <svg class="w-5 h-5 text-gray-500 transform transition-transform"
                                                             :class="{ 'rotate-180': openFaq === {{ $loop->parent->index }}_{{ $index }} }"
                                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </button>
                                                    <div x-show="openFaq === {{ $loop->parent->index }}_{{ $index }}"
                                                         x-transition:enter="transition ease-out duration-200"
                                                         x-transition:enter-start="opacity-0 transform scale-95"
                                                         x-transition:enter-end="opacity-100 transform scale-100"
                                                         x-transition:leave="transition ease-in duration-150"
                                                         x-transition:leave-start="opacity-100 transform scale-100"
                                                         x-transition:leave-end="opacity-0 transform scale-95"
                                                         class="px-4 pb-3"
                                                         style="display: none;">
                                                    <div class="text-gray-600">
                                                        {!! nl2br(e($faq->answer)) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-public-layout>