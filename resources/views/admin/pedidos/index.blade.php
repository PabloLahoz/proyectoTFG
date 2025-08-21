<x-layouts.layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-xl rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Listado de pedidos</h2>
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
                        <th class="px-4 py-2">ID Cliente</th>
                        <th class="px-4 py-2">Dirección de envío</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Método de pago</th>
                        <th class="px-4 py-2">Fecha pedido</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($pedidos as $pedido)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $pedido->cliente_id }}</td>
                            <td class="px-4 py-2">{{ $pedido->direccion_envio }}</td>
                            <td class="px-4 py-2 capitalize">{{ $pedido->estado }}</td>
                            <td class="px-4 py-2">{{ $pedido->metodo_pago }}</td>
                            <td class="px-4 py-2">{{ $pedido->fecha_pedido->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">No hay pedidos registrados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</x-layouts.layout>
