<aside class="w-64 min-h-screen bg-base-200 p-4">
    <ul class="menu">
        <li>
            <a href="{{ route('home') }}">
                <i class="bi bi-grid mr-2"></i>
                Dashboard
            </a>
        </li>

        @can('ver-ventas')
            <li>
                <details>
                    <summary>
                        <i class="fa-solid fa-cart-shopping mr-2"></i>
                        Ventas
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('ventas-nueva') }}">
                                <i class="bi bi-circle mr-2"></i>
                                Vender Producto
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('detalle-venta') }}">
                                <i class="bi bi-circle mr-2"></i>
                                Consultar Ventas
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
        @endcan

        @can('ver-admin')
            <li>
                <a href="{{ route('categorias') }}">
                    <i class="fa-solid fa-list-check mr-2"></i>
                    Categorias
                </a>
            </li>

            <li>
                <details>
                    <summary>
                        <i class="fa-solid fa-window-restore mr-2"></i>
                        Productos
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('productos') }}">
                                <i class="bi bi-circle mr-2"></i>
                                Administrar productos
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reportes_productos') }}">
                                <i class="bi bi-circle mr-2"></i>
                                Reportes de productos
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li>
                <a href="{{ route('compras') }}">
                    <i class="fa-solid fa-shop mr-2"></i>
                    Compras
                </a>
            </li>

            <li>
                <a href="{{ route('proveedores') }}">
                    <i class="fa-solid fa-truck mr-2"></i>
                    Proveedores
                </a>
            </li>

            <li>
                <a href="{{ route('usuarios') }}">
                    <i class="fa-solid fa-users mr-2"></i>
                    Usuarios
                </a>
            </li>
        @endcan
    </ul>
</aside>

