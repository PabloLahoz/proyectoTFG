<x-layouts.layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="p-4">
                <nav class="space-y-2">
                    <a href="{{ route('cliente.pedidos.index') }}"
                       class="block px-4 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('cliente.pedidos.show') ? 'bg-gray-200 text-gray-800 font-bold' : 'text-gray-700 hover:bg-gray-100' }}">
                        Pedidos
                    </a>
                    <a href="{{ route('cliente.direcciones.index') }}"
                       class="block px-4 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('cliente.direcciones.index') ? 'bg-gray-200 text-gray-800 font-bold' : 'text-gray-700 hover:bg-gray-100' }}">
                        Direcciones
                    </a>
                    <a href="{{ route('cliente.perfil.show') }}"
                       class="block px-4 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('cliente.perfil.show') ? 'bg-gray-200 text-gray-800 font-bold' : 'text-gray-700 hover:bg-gray-100' }}">
                        Datos
                    </a>
                </nav>
            </div>

            <div class="md:col-span-3">
                <div class="bg-white shadow rounded-lg p-6">
                    <a href="{{ route('cliente.pedidos.index') }}"
                       class="mt-4 inline-block text-blue-600 hover:underline">← Volver al listado</a>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Detalle del pedido #{{ $pedido->id }}</h2>

                    <p class="text-gray-800"><strong>Fecha:</strong> {{ $pedido->fecha_pedido->format('d/m/Y') }}</p>
                    <p class="text-gray-800"><strong>Dirección de envío:</strong> {{ $pedido->direccion->destinatario }}, {{ $pedido->direccion->direccion }} {{ $pedido->direccion->codigo_postal }} {{ $pedido->direccion->ciudad }} {{ $pedido->direccion->provincia }} {{ $pedido->direccion->telefono }}</p>
                    <p class="text-gray-800"><strong>Método de pago:</strong> {{ ucfirst($pedido->metodo_pago) }}</p>
                    <p class="text-gray-800"><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
                    <p class="text-gray-800"><strong>Total:</strong> € {{ number_format($pedido->total_pedido, 2) }}</p>

                    <h3 class="text-xl font-semibold mt-6 mb-2 text-gray-700">Productos</h3>

                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2">Producto</th>
                                <th class="px-4 py-2">Precio unitario</th>
                                <th class="px-4 py-2">Cantidad</th>
                                <th class="px-4 py-2">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                            @foreach($pedido->detalles as $detalle)
                                <tr>
                                    <td class="px-4 py-2 text-gray-800 text-center">{{ $detalle->producto->nombre }}</td>
                                    <td class="px-4 py-2 text-gray-800 text-center">€ {{ number_format($detalle->precio_unitario, 2) }}</td>
                                    <td class="px-4 py-2 text-gray-800 text-center">{{ $detalle->cantidad }}</td>
                                    <td class="px-4 py-2 text-gray-800 text-center">
                                        € {{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-6 flex space-x-4">
                    {{-- Botón de cancelar solo si el pedido está pagado --}}
                    @if ($pedido->estado === 'pagado')
                        <form action="{{ route('cliente.pedidos.cancelar', $pedido) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-2xl hover:bg-red-700">
                                Cancelar pedido
                            </button>
                        </form>
                    @endif

                    {{-- Botón de marcar como entregado si aún no lo está --}}
                    @if ($pedido->estado === 'pagado')
                        <form action="{{ route('cliente.pedidos.entregar', $pedido) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded-2xl hover:bg-green-700">
                                Marcar como entregado
                            </button>
                        </form>
                    @endif

                    {{-- Botón de factura solo si el pedido está entregado --}}
                    @if ($pedido->estado === 'entregado')
                        <a href="{{ route('cliente.pedidos.factura', $pedido) }}" target="_blank"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700">
                            Ver factura
                        </a>
                    @endif
                </div>


            </div>
        </div>


    </div>
</x-layouts.layout>
