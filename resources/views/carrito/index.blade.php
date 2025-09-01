<x-layouts.layout :titulo="'Carrito'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Carrito de compras</h1>

        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: "{{ session('success') }}",
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: '¡Error!',
                        text: "{{ session('error') }}",
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        @php
            $carrito = session('carrito', []);
        @endphp

        @if(empty($carrito))
            <p class="text-gray-500">Tu carrito está vacío.</p>
        @else
            <div class="mb-4 flex justify-end">
                <form id="vaciar-carrito-form" action="{{ route('carrito.vaciar') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" id="vaciar-carrito-btn" class="btn btn-error btn-sm">
                        Vaciar carrito
                    </button>
                </form>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6">
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100 text-left text-sm text-gray-700">
                        <tr>
                            <th class="px-4 py-2">Imagen</th>
                            <th class="px-4 py-2">Producto</th>
                            <th class="px-4 py-2">Precio</th>
                            <th class="px-4 py-2">Cantidad</th>
                            <th class="px-4 py-2">Subtotal</th>
                            <th class="px-4 py-2">Acción</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                        @php $total = 0; @endphp
                        @foreach($carrito as $id => $producto)
                            @php
                                $subtotal = $producto['precio'] * $producto['cantidad'];
                                $total += $subtotal;
                                $stock = $producto['stock'] ?? 0;
                            @endphp
                            <tr>
                                <td class="px-4 py-3">
                                    @if(isset($producto['imagen']))
                                        <a href="{{ route('catalogo.show', ['producto' => $producto['id']]) }}">
                                            <img src="{{ Storage::disk('s3')->url($producto['imagen']['ruta']) }}"
                                                 alt="{{ $producto['nombre'] }}"
                                                 class="w-16 h-16 object-cover rounded"/>
                                        </a>
                                    @else
                                        <span class="text-gray-400">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $producto['nombre'] }}</td>
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    €{{ number_format($producto['precio'], 2) }}</td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('carrito.actualizar', $id) }}" method="POST"
                                          class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="number"
                                               name="cantidad"
                                               min="1"
                                               max="{{ $stock }}"
                                               value="{{$producto['cantidad']}}"
                                               class="px-3 py-2 border border-gray-300 rounded-md w-20 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800"
                                               required/>
                                        <button type="submit" class="btn btn-sm btn-outline btn-info">Actualizar
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800">€{{ number_format($subtotal, 2) }}</td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('carrito.eliminar', $id) }}" method="POST" class="eliminar-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="btn btn-sm btn-outline btn-error eliminar-btn"
                                                data-producto="{{ $producto['nombre'] }}">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        <tr class="bg-gray-50 font-semibold">
                            <td colspan="4" class="px-4 py-3 text-right text-gray-700">Total:</td>
                            <td class="px-4 py-3 text-gray-800">€{{ number_format($total, 2) }}</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 text-right">
                <a href="{{route ('checkout-wizard')}}" class="btn btn-primary">Realizar pedido</a>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const vaciarBtn = document.getElementById('vaciar-carrito-btn');
            const vaciarForm = document.getElementById('vaciar-carrito-form');

            if (vaciarBtn && vaciarForm) {
                vaciarBtn.addEventListener('click', function () {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Se eliminarán todos los productos del carrito",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, vaciar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            vaciarForm.submit();
                        }
                    });
                });
            }

            const eliminarBtns = document.querySelectorAll('.eliminar-btn');
            eliminarBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const form = this.closest('form');
                    const nombreProducto = this.dataset.producto;
                    Swal.fire({
                        title: '¿Eliminar producto?',
                        text: `¿Deseas eliminar "${nombreProducto}" del carrito?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-layouts.layout>
