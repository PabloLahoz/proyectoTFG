<!-- Este código requiere Alpine.js -->
<div class="relative" x-data="{ open: false }">
    <!-- Icono de usuario -->
    <button @click="open = !open" class="focus:outline-none">
        <svg class="w-6 h-6 text-white hover:text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 -3 24 24">
            <path d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>

    </button>

    <!-- Dropdown -->
    <div
        x-show="open"
        @click.away="open = false"
        x-transition
        class="absolute right-0 mt-2 w-64 bg-white shadow-xl rounded-lg p-4 z-50"
    >
        @auth
            <p class="text-gray-800 font-semibold mb-2">¡Hola, {{ Auth::user()->name }}!</p>
            <a href="{{route('cliente.perfil.show')}}" class="block text-blue-600 hover:underline mb-2">Ver perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-red-600 hover:underline">Cerrar sesión</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}"
               class="block w-full bg-blue-600 text-white text-center px-4 py-2 rounded hover:bg-blue-700 mb-3">
                Iniciar sesión
            </a>
            <p class="text-sm text-gray-600 mb-1">¿Todavía no tienes cuenta?</p>
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline text-sm">
                Regístrate aquí
            </a>
        @endguest
    </div>
</div>
