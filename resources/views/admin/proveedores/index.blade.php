<x-layouts.layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Proveedores</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Administrar Proveedores</h2>
            <p class="text-gray-500 mb-4">Administrar los proveedores de nuestros productos.</p>

            <div class="mb-4">
                <a href="{{ route('proveedores.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
                    <i class="fa-solid fa-circle-plus mr-2"></i> Agregar nuevo proveedor
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-center border border-gray-200">
                    <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Teléfono</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">CP</th>
                        <th class="px-4 py-2 border">Sitio Web</th>
                        <th class="px-4 py-2 border">Nota</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @foreach ($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $item->nombre }}</td>
                            <td class="px-4 py-2">{{ $item->telefono }}</td>
                            <td class="px-4 py-2">{{ $item->email }}</td>
                            <td class="px-4 py-2">{{ $item->cp }}</td>
                            <td class="px-4 py-2">{{ $item->sitio_web }}</td>
                            <td class="px-4 py-2">{{ $item->notas }}</td>
                            <td class="px-4 py-2 flex justify-center space-x-2">
                                <a href="{{ route('proveedores.edit', $item->id) }}" class="text-yellow-500 hover:text-yellow-600">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('proveedores.show', $item->id) }}" class="text-red-600 hover:text-red-700">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.layout>
