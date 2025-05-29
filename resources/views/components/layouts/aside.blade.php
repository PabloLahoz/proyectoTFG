<aside class="w-64 min-h-screen p-4">
    <ul class="menu">
        <li>
            <a href="{{ route('admin.dashboard')}}">
                <i class="bi bi-grid mr-2"></i>
                Dashboard
            </a>
        </li>


        <li>
            <a href="{{ route('admin.pedidos.index')}}">
                <i class="fa-solid fa-cart-shopping mr-2"></i>
                Pedidos
            </a>
        </li>

        <li>
            <a href="{{ route('admin.productos.index')}}">
                <i class="fa-solid fa-cart-shopping mr-2"></i>
                Productos
            </a>
        </li>

        <li>
            <a href="{{ route('admin.compras.index') }}">
                <i class="fa-solid fa-shop mr-2"></i>
                Compras
            </a>
        </li>

        <li>
            <a href="{{ route('admin.proveedores.index') }}">
                <i class="fa-solid fa-truck mr-2"></i>
                Proveedores
            </a>
        </li>

        <li>
            <a href="{{route('admin.clientes.index')}}">
                <i class="fa-solid fa-users mr-2"></i>
                Usuarios
            </a>
        </li>

    </ul>
</aside>

