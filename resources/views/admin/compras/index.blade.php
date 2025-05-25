<x-layouts.layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Compras de productos</h1>
    </div>

    <section class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Administrar compras</h2>
        <p class="text-gray-500 mb-4">Administrar la compra de productos.</p>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                <tr class="text-center text-sm font-semibold text-gray-700">
                    <th class="border border-gray-300 px-4 py-2">Usuario</th>
                    <th class="border border-gray-300 px-4 py-2">Producto</th>
                    <th class="border border-gray-300 px-4 py-2">Cantidad</th>
                    <th class="border border-gray-300 px-4 py-2">Precio de compra</th>
                    <th class="border border-gray-300 px-4 py-2">Total compra</th>
                    <th class="border border-gray-300 px-4 py-2">Fecha</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr class="text-center text-sm text-gray-600 hover:bg-gray-50 transition">
                        <td class="border border-gray-300 px-4 py-2">{{ $item->nombre_usuario }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->nombre_producto }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->cantidad }}</td>
                        <td class="border border-gray-300 px-4 py-2">${{ $item->precio_compra }}</td>
                        <td class="border border-gray-300 px-4 py-2">${{ $item->precio_compra * $item->cantidad }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->created_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('compras.edit', $item->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('compras.show', $item->id) }}"
                                   class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layouts.layout>
