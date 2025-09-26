<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre completo')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Teléfono')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Address Line 1 -->
        <div class="mt-4">
            <x-input-label for="address_line1" :value="__('Dirección principal')" />
            <x-text-input id="address_line1" class="block mt-1 w-full" type="text" name="address_line1" :value="old('address_line1')" required autocomplete="address-line1" />
            <x-input-error :messages="$errors->get('address_line1')" class="mt-2" />
        </div>

        <!-- Address Line 2 -->
        <div class="mt-4">
            <x-input-label for="address_line2" :value="__('Referencia adicional (opcional)')" />
            <x-text-input id="address_line2" class="block mt-1 w-full" type="text" name="address_line2" :value="old('address_line2')" autocomplete="address-line2" />
            <x-input-error :messages="$errors->get('address_line2')" class="mt-2" />
        </div>

        <div class="mt-4 grid gap-4 md:grid-cols-3">
            <div>
                <x-input-label for="city" :value="__('Ciudad')" />
                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" autocomplete="address-level2" />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="state" :value="__('Departamento / Estado')" />
                <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state')" autocomplete="address-level1" />
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="postal_code" :value="__('Código postal')" />
                <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" autocomplete="postal-code" />
                <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms -->
        <div class="mt-6">
            <label for="terms" class="flex items-start gap-3">
                <input id="terms" type="checkbox" name="terms" value="1" class="mt-1 size-4 rounded border-gray-300 text-red-600 focus:ring-red-500 dark:border-gray-600 dark:bg-gray-800" {{ old('terms') ? 'checked' : '' }} required>
                <span class="text-sm text-gray-600 dark:text-gray-300 leading-5">
                    {!! __('Acepto los :terms y la :privacy de Cielo Carnes.', [
                        'terms' => '<a href="'.route('terms').'" class="font-semibold underline hover:text-red-600">'.__('Condiciones de uso').'</a>',
                        'privacy' => '<a href="'.route('privacy').'" class="font-semibold underline hover:text-red-600">'.__('Política de privacidad').'</a>',
                    ]) !!}
                </span>
            </label>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('¿Ya tienes una cuenta?') }}
            </a>

            <x-primary-button class="ms-4 bg-red-600 hover:bg-red-700 focus:ring-red-500">
                {{ __('Registrarme') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
