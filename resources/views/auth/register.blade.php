<x-layouts.layout>
    <section class="flex flex-1 w-full">
        <!-- Imagen a la izquierda -->
        <div class="w-1/2 hidden md:block">
            <img src="{{ asset('img/registro.jpg') }}" alt="Imagen de registro" class="object-cover w-full h-full">
        </div>

        <!-- Formulario a la derecha -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8">
            <form method="POST" action="{{ route('register') }}" class="w-full max-w-md">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Empresa -->
                <div class="mt-4">
                    <x-input-label for="empresa" :value="__('Nombre de la empresa')" />
                    <x-text-input id="empresa" class="block mt-1 w-full" type="text" name="empresa" :value="old('empresa')" autocomplete="organization" />
                    <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('¿Ya estás registrado?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Registrarse') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.layout>
