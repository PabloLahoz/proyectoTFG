<x-layouts.admin :titulo="'Listado pedidos'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Pedidos</h1>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-6">
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800">Listado de pedidos</h2>
                </div>
                <p class="text-gray-500 mt-2">
                    Aquí puedes revisar los pedidos realizados por los clientes.
                </p>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 whitespace-nowrap">ID Cliente</th>
                        <th class="px-4 py-2 whitespace-nowrap">Dirección de envío</th>
                        <th class="px-4 py-2 whitespace-nowrap">Estado</th>
                        <th class="px-4 py-2 whitespace-nowrap">Método de pago</th>
                        <th class="px-4 py-2 whitespace-nowrap">Fecha pedido</th>
                        <th class="px-4 py-2 whitespace-nowrap">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($pedidos as $pedido)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-gray-800 text-center">{{ $pedido->cliente_id }}</td>
                            <td class="px-4 py-2 text-gray-800">
                                @if($pedido->direccion)
                                    <div class="text-sm">
                                        <div class="font-medium">{{ $pedido->direccion->destinatario }}</div>
                                        <div>{{ $pedido->direccion->direccion }}</div>
                                        <div>{{ $pedido->direccion->codigo_postal }} {{ $pedido->direccion->ciudad }}</div>
                                        <div>{{ $pedido->direccion->provincia }}</div>
                                        <div class="text-blue-600">📞 {{ $pedido->direccion->telefono }}</div>
                                        @if($pedido->direccion->alias)
                                            <span class="text-xs text-gray-500">({{ $pedido->direccion->alias }})</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-red-500 text-sm">Dirección no disponible</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($pedido->estado == 'entregado')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full flex justify-center">Entregado</span>
                                @elseif($pedido->estado == 'pagado')
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-500 bg-yellow-100 rounded-full flex justify-center">Pagado</span>
                                @elseif($pedido->estado == 'cancelado')
                                    <span class="px-2 py-1 text-xs font-semibold text-red-500 bg-red-100 rounded-full flex justify-center">Cancelado</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-gray-800 text-center">{{ $pedido->metodo_pago }}</td>
                            <td class="px-4 py-2 text-gray-800 text-center">{{ $pedido->fecha_pedido->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.pedidos.show', $pedido) }}" class="flex justify-center">
                                    <span class="bg-blue-600 text-white p-2 rounded-xl hover:bg-blue-800 transition">
                                        <x-heroicon-o-eye class="w-5 h-5"/>
                                    </span>
                                </a>
                            </td>

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
</x-layouts.admin>
