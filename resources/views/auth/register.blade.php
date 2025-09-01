<x-layouts.layout :titulo="'Registrarse'">
    <section class="h-full flex items-center justify-center bg-gray-50 overflow-hidden">
        <form method="POST" action="{{ route('register') }}" class="w-full max-w-md bg-white p-8 rounded-lg shadow">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block mt-1 w-full text-gray-800"
                              type="text" name="name"
                              :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full text-gray-800"
                              type="email" name="email"
                              :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Empresa -->
            <div class="mt-4">
                <x-input-label for="empresa" :value="__('Nombre de la empresa')" />
                <x-text-input id="empresa" class="block mt-1 w-full text-gray-800"
                              type="text" name="empresa"
                              :value="old('empresa')" autocomplete="organization" />
                <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full text-gray-800"
                              type="password" name="password"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full text-gray-800"
                              type="password" name="password_confirmation"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                   href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>

                <x-primary-button>
                    {{ __('Registrarse') }}
                </x-primary-button>
            </div>
        </form>
    </section>
</x-layouts.layout>
