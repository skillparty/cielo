<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
            {{ __('Completa tu perfil') }}
        </h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Necesitamos algunos datos adicionales para finalizar la creación de tu cuenta con Google.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('auth.google.complete.post') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nombre completo')" />
            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full"
                          value="{{ old('name', $name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Correo electrónico (opcional)')" />
            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
                          value="{{ old('email', $email) }}" autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                {{ __('Si Google no compartió tu correo, puedes ingresar uno para recibir notificaciones y verificar tu cuenta.') }}
            </p>
        </div>

        <div>
            <x-input-label for="phone" :value="__('Teléfono')" />
            <x-text-input id="phone" name="phone" type="text" class="block mt-1 w-full"
                          value="{{ old('phone') }}" required autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="address_line1" :value="__('Dirección principal')" />
            <x-text-input id="address_line1" name="address_line1" type="text" class="block mt-1 w-full"
                          value="{{ old('address_line1') }}" required autocomplete="address-line1" />
            <x-input-error class="mt-2" :messages="$errors->get('address_line1')" />
        </div>

        <div>
            <x-input-label for="address_line2" :value="__('Referencia adicional (opcional)')" />
            <x-text-input id="address_line2" name="address_line2" type="text" class="block mt-1 w-full"
                          value="{{ old('address_line2') }}" autocomplete="address-line2" />
            <x-input-error class="mt-2" :messages="$errors->get('address_line2')" />
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <x-input-label for="city" :value="__('Ciudad')" />
                <x-text-input id="city" name="city" type="text" class="block mt-1 w-full"
                              value="{{ old('city') }}" autocomplete="address-level2" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div>
                <x-input-label for="state" :value="__('Departamento / Estado')" />
                <x-text-input id="state" name="state" type="text" class="block mt-1 w-full"
                              value="{{ old('state') }}" autocomplete="address-level1" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>

            <div>
                <x-input-label for="postal_code" :value="__('Código postal')" />
                <x-text-input id="postal_code" name="postal_code" type="text" class="block mt-1 w-full"
                              value="{{ old('postal_code') }}" autocomplete="postal-code" />
                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
            </div>
        </div>

        <div class="flex items-start gap-3">
            <input id="terms" name="terms" type="checkbox" value="1"
                   class="mt-1 size-4 rounded border-gray-300 text-red-600 focus:ring-red-500 dark:border-gray-600 dark:bg-gray-800"
                   {{ old('terms') ? 'checked' : '' }} required>
            <span class="text-sm text-gray-600 dark:text-gray-300 leading-5">
                {!! __('Acepto los :terms y la :privacy de Cielo Carnes.', [
                    'terms' => '<a href="'.route('terms').'" class="font-semibold underline hover:text-red-600">'.__('Condiciones de uso').'</a>',
                    'privacy' => '<a href="'.route('privacy').'" class="font-semibold underline hover:text-red-600">'.__('Política de privacidad').'</a>',
                ]) !!}
            </span>
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('terms')" />

        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('logout') }}"
               class="text-sm text-gray-500 underline hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Cancelar y regresar al inicio de sesión') }}
            </a>
            <x-primary-button class="bg-red-600 hover:bg-red-700 focus:ring-red-500">
                {{ __('Finalizar registro') }}
            </x-primary-button>
        </div>
    </form>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
        @csrf
    </form>
</x-guest-layout>