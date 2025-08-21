<x-layouts.layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-xl rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Listado de clientes</h2>
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
                            <td class="px-4 py-2">{{ $cliente->id }}</td>
                            <td class="px-4 py-2">{{ $cliente->name }}</td>
                            <td class="px-4 py-2">{{ $cliente->empresa }}</td>
                            <td class="px-4 py-2">{{ $cliente->email }}</td>
                            <td class="px-4 py-2 capitalize">{{ $cliente->rol }}</td>
                            <td class="px-4 py-2">
                                @if($cliente->delete_at)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-red-700 bg-green-100 rounded-full">Desactivado</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-red-100 rounded-full">Activo</span>
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
</x-layouts.layout>

