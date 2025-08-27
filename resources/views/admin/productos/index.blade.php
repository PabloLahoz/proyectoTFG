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
            <h1 class="text-3xl font-bold text-gray-800">Productos</h1>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-6">
            <div class="mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                    <h2 class="text-2xl font-semibold text-gray-800">Listado de productos</h2>
                    <a href="{{ route('admin.productos.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-2xl hover:bg-blue-700 transition w-full md:w-auto text-center">
                        Nuevo producto
                    </a>
                </div>
                <p class="text-gray-500 mt-2">
                    Aquí puedes consultar, editar o eliminar productos registrados en el sistema.
                </p>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Material</th>
                        <th class="px-4 py-2">Dimensiones</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Imagen</th>
                        <th class="px-4 py-2">Precio Venta</th>
                        <th class="px-4 py-2">Precio Última Compra</th>
                        <th class="px-4 py-2">Disponibilidad</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($productos as $producto)
                        <tr class="hover:bg-gray-50 {{ $producto->trashed() ? 'bg-gray-100 text-gray-500' : '' }}">
                            <td class="px-4 py-2 text-center">{{ $producto->nombre }}</td>
                            <td class="px-4 py-2 text-center">{{ $producto->material }}</td>
                            <td class="px-4 py-2 text-center">{{ $producto->dimensiones }}</td>
                            <td class="px-4 py-2 text-center">{{ $producto->estado }}</td>
                            <td class="px-4 py-2 text-center">{{ $producto->cantidad }}</td>
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/' . $producto->imagen->ruta) }}" alt="" width="60px" height="60px">
                            </td>
                            <td class="px-4 py-2 text-center">€ {{ number_format($producto->precio_venta, 2) }}</td>
                            <td class="px-4 py-2 text-center">€ {{ number_format($producto->precio_ultima_compra, 2) }}</td>
                            <td class="px-4 py-2">
                                @if($producto->activo && !$producto->trashed())
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Disponible</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">No disponible</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 flex justify-center gap-2">
                                @if(!$producto->trashed())
                                    {{-- Editar --}}
                                    <a href="{{ route('admin.productos.edit', $producto) }}"
                                       class="bg-blue-600 text-white p-2 rounded-xl hover:bg-blue-800 transition">
                                        <x-heroicon-o-pencil-square class="w-5 h-5"/>
                                    </a>

                                    {{-- Eliminar --}}
                                    <form id="deleteForm{{$producto->id}}" action="{{ route('admin.productos.destroy', $producto) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                onclick="confirmDeleteProduct('deleteForm{{$producto->id}}', '{{$producto->nombre}}', {{$producto->cantidad}})"
                                                class="bg-red-500 text-white p-2 rounded-xl hover:bg-red-600 transition">
                                            <x-heroicon-o-trash class="w-5 h-5"/>
                                        </button>
                                    </form>
                                @else
                                    {{-- Reactivar --}}
                                    <form action="{{ route('admin.productos.restore', $producto->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white p-2 rounded-xl hover:bg-green-600 transition">
                                            <x-heroicon-o-arrow-path class="w-5 h-5"/>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">No hay productos registrados.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
