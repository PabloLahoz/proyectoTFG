<x-layouts.admin>

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
                    title: 'Error',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Compras de productos</h1>
        </div>

        <section class="bg-white p-6 rounded-2xl shadow-xl">
            <div class="mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-700">Administrar compras</h2>
                    <a href="{{ route('admin.compras.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-2xl hover:bg-blue-700 transition">
                        Nueva compra
                    </a>
                </div>
                <p class="text-gray-500 mt-1">Aquí puedes gestionar las compras realizadas a proveedores.</p>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Proveedor</th>
                        <th class="px-4 py-2">Producto</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Precio unitario</th>
                        <th class="px-4 py-2">Total compra</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $item)
                        <tr class="text-center text-sm text-gray-800 hover:bg-gray-50 transition">
                            <td class="px-4 py-2">{{$item->nombre_proveedor}}</td>
                            <td class="px-4 py-2">{{$item->nombre_producto}}</td>
                            <td class="px-4 py-2">{{ $item->cantidad }}</td>
                            <td class="px-4 py-2">{{ $item->precio_compra }} €</td>
                            <td class="px-4 py-2">{{ $item->precio_compra * $item->cantidad }} €</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-layouts.admin>
