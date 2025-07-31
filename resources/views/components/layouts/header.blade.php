<header class="bg-[#2F855A] shadow" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="object-contain w-28 h-28">
            <span class="text-xl font-bold text-gray-800">MiTienda</span>
        </div>

        <!-- Botón menú hamburguesa (solo visible en móviles) -->
        <button @click="open = !open" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Navegación principal (oculta en móviles) -->
        <nav class="hidden md:flex space-x-6 text-gray-700 font-medium">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Inicio</a>
            <a href="{{route('catalogo')}}" class="hover:text-blue-600">Productos</a>
            <a href="{{ route('contacto') }}" class="hover:text-blue-600">Contacto</a>
        </nav>

        <!-- Buscador + iconos -->
        <div class="hidden md:flex items-center space-x-4">
            <!-- Campo de texto -->
            <input type="text" placeholder="Buscar..." class="px-3 py-1 border rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

            <!-- Carrito -->
            <a href="{{route('carrito.index')}}" class="relative">
                <svg class="w-6 h-6 text-gray-700 hover:text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </a>

            <!-- Usuario -->
            <x-layouts.usuario-dropdown/>
        </div>
    </div>

    <!-- Menú móvil -->
    <div class="md:hidden" x-show="open" x-transition>
        <nav class="px-4 pt-4 pb-4 space-y-2 text-gray-700">
            <a href="{{ route('home') }}" class="block hover:text-blue-600">Inicio</a>
            <a href="" class="block hover:text-blue-600">Productos</a>
            <a href="{{ route('contacto') }}" class="block hover:text-blue-600">Contacto</a>

            <!-- Buscador y botones móviles -->
            <div class="mt-4 space-y-4">
                <input type="text" placeholder="Buscar..." class="w-full px-3 py-1 border rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                <div class="flex space-x-6">
                    <a href="">
                        <svg class="w-6 h-6 text-gray-700 hover:text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 7M7 13l-1.5 7h13L17 13M6 21a1 1 0 100-2 1 1 0 000 2zm12 0a1 1 0 100-2 1 1 0 000 2z" />
                        </svg>
                    </a>
                    <a href="">
                        <svg class="w-6 h-6 text-gray-700 hover:text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5.121 17.804A10 10 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
