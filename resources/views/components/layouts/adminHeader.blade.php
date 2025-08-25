<header class="bg-white h-16 flex items-center justify-between p-6 shadow-md z-50 ">
    <h1 class="text-lg font-semibold text-gray-700">Panel de Administración</h1>
    <nav class="flex items-center space-x-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 text-sm">
                Cerrar sesión
            </button>
        </form>
    </nav>
</header>
