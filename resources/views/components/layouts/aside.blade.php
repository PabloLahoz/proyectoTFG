<aside class="w-64 h-full bg-white shadow-lg z-40 pt-2">
    <ul class="space-y-1 m-3">
        <li>
            <a href="{{ route('admin.dashboard')}}"
               class="flex items-center px-4 py-2 mx-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md transition">
                <x-heroicon-o-home class="w-5 h-5 mr-2" />
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('admin.pedidos.index')}}"
               class="flex items-center px-4 py-2 mx-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md transition">
                <x-heroicon-o-currency-euro class="w-5 h-5 mr-2" />
                Pedidos
            </a>
        </li>

        <li>
            <a href="{{ route('admin.productos.index')}}"
               class="flex items-center px-4 py-2 mx-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md transition">
                <x-heroicon-o-inbox-stack class="w-5 h-5 mr-2" />
                Productos
            </a>
        </li>

        <li>
            <a href="{{ route('admin.compras.index') }}"
               class="flex items-center px-4 py-2 mx-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md transition">
                <x-heroicon-o-shopping-cart class="w-5 h-5 mr-2" />
                Compras
            </a>
        </li>

        <li>
            <a href="{{ route('admin.proveedores.index') }}"
               class="flex items-center px-4 py-2 mx-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md transition">
                <x-heroicon-o-truck class="w-5 h-5 mr-2" />
                Proveedores
            </a>
        </li>

        <li>
            <a href="{{route('admin.clientes.index')}}"
               class="flex items-center px-4 py-2 mx-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md transition">
                <x-heroicon-o-users class="w-5 h-5 mr-2" />
                Usuarios
            </a>
        </li>

        <li>
            <a href="{{route('admin.diagramas')}}"
               class="flex items-center px-4 py-2 mx-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md transition">
                <x-heroicon-o-chart-bar-square class="w-5 h-5 mr-2" />
                Diagramas
            </a>
        </li>
    </ul>
</aside>
