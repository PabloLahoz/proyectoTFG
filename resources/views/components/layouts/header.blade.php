<header class="bg-green-800 shadow-sm">
    <nav class="flex justify-between items-center w-[92%] mx-auto py-4">
        <!-- Logo -->
        <div class="flex items-center">
            <img class="w-20 h-20 cursor-pointer z-10" src="{{ asset('img/logo.png') }}" alt="Logo">
        </div>

        <!-- Enlaces de navegación -->
        <div class="nav-links duration-500 md:static absolute bg-green-800 md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-5 z-50">
            <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                <li>
                    <a class="hover:text-gray-300 text-white font-medium" href="{{ route('home') }}">Inicio</a>
                </li>
                <li>
                    <a class="hover:text-gray-300 text-white font-medium" href="{{ route('catalogo') }}">Productos</a>
                </li>
                <li>
                    <a class="hover:text-gray-300 text-white font-medium" href="{{ route('contacto') }}">Contacto</a>
                </li>
            </ul>
        </div>

        <!-- Elementos de la derecha -->
        <div class="flex items-center gap-4">
            <!-- Barra de búsqueda en desktop -->


            <a href="{{route('carrito.index')}}">
                <x-heroicon-o-shopping-cart class="w-6 h-6 mr-2 text-white hover:text-gray-300" />
            </a>

            <x-layouts.usuario-dropdown/>

            <!-- Botón de menú móvil -->
            <button onclick="onToggleMenu(this)" class="text-3xl cursor-pointer md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </nav>
</header>

<script>
    const navLinks = document.querySelector('.nav-links');

    function onToggleMenu(e){
        const isMenu = e.innerHTML.includes('M4 6h16');
        if (isMenu) {
            e.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>`;
        } else {
            e.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>`;
        }
        navLinks.classList.toggle('top-[9%]');
    }
</script>
