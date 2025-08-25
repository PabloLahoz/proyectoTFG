<x-layouts.admin>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Clientes</h1>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-6">
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800">Listado de clientes</h2>
                </div>
                <p class="text-gray-500 mt-2">
                    Aquí puedes ver los clientes registrados en el sistema.
                </p>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Empresa</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Rol</th>
                        <th class="px-4 py-2">Estado</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($clientes as $cliente)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-gray-800 text-center">{{ $cliente->id }}</td>
                            <td class="px-4 py-2 text-gray-800 text-center">{{ $cliente->name }}</td>
                            <td class="px-4 py-2 text-gray-800 text-center">{{ $cliente->empresa }}</td>
                            <td class="px-4 py-2 text-gray-800 text-center">{{ $cliente->email }}</td>
                            <td class="px-4 py-2 capitalize text-gray-800 text-center">{{ $cliente->rol }}</td>
                            <td class="px-4 py-2 text-gray-800 text-center">
                                @if($cliente->delete_at)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Desactivado</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Activo</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">No hay clientes registrados.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</x-layouts.admin>

