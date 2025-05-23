<!-- resources/views/layouts/app.blade.php o tu header.blade.php -->
<header class="bg-white shadow p-4 flex justify-between items-center">
    <!-- Logo y navegación -->
    <div class="flex items-center gap-6">
        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">MiTienda</a>
        <nav class="flex gap-4">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Inicio</a>
            <a href="{{ route('productos.index') }}" class="text-gray-700 hover:text-blue-600">Productos</a>
            <a href="{{ route('contacto') }}" class="text-gray-700 hover:text-blue-600">Contacto</a>
        </nav>
    </div>

    <!-- Campo de búsqueda, carrito y usuario -->
    <div class="flex items-center gap-4">
        <!-- Campo de búsqueda -->
        <input type="text" placeholder="Buscar..." class="border rounded px-3 py-1">

        <!-- Carrito -->
        <a href="{{ route('carrito') }}">
            <svg class="w-6 h-6 text-gray-700 hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13L17 13H7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>

        <!-- Aquí va el icono de usuario con desplegable -->
        @include('partials.usuario-dropdown')
    </div>
</header>
