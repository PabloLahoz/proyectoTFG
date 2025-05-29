<x-layouts.layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-xl rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Listado de productos</h2>
                <a href="{{ route('admin.productos.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    + Nuevo producto
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 text-green-700 bg-green-100 border border-green-200 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Material</th>
                        <th class="px-4 py-2">Dimensiones</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Precio Venta</th>
                        <th class="px-4 py-2">Precio Última Compra</th>
                        <th class="px-4 py-2">Disponibilidad</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($productos as $producto)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $producto->nombre }}</td>
                            <td class="px-4 py-2">{{ $producto->material }}</td>
                            <td class="px-4 py-2">{{ $producto->dimensiones }}</td>
                            <td class="px-4 py-2 capitalize">{{ $producto->estado }}</td>
                            <td class="px-4 py-2">{{ $producto->cantidad }}</td>
                            <td class="px-4 py-2">€ {{ number_format($producto->precio_venta, 2) }}</td>
                            <td class="px-4 py-2">€ {{ number_format($producto->precio_ultima_compra, 2) }}</td>
                            <td class="px-4 py-2">
                                @if($producto->activo)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Disponible</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">No disponible</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('admin.productos.edit', $producto) }}"
                                   class="text-yellow-600 hover:underline">Editar</a>
                                <form action="{{ route('admin.productos.destroy', $producto) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">No hay productos registrados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</x-layouts.layout>
