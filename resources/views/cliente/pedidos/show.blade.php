<x-layouts.layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow rounded-lg p-4">
            <nav class="space-y-2">
                <a href="{{ route('cliente.perfil.show') }}"
                   class="block px-4 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('cliente.perfil.show') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Perfil
                </a>
                <a href="{{ route('cliente.pedidos.index') }}"
                   class="block px-4 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('cliente.pedidos.index') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Mis pedidos
                </a>
            </nav>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-6">
            <a href="{{ route('cliente.pedidos.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">← Volver al listado</a>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Detalle del pedido #{{ $pedido->id }}</h2>

            <p><strong>Fecha:</strong> {{ $pedido->fecha_pedido->format('d/m/Y') }}</p>
            <p><strong>Dirección de envío:</strong> {{ $pedido->direccion_envio }}</p>
            <p><strong>Método de pago:</strong> {{ ucfirst($pedido->metodo_pago) }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
            <p><strong>Total:</strong> € {{ number_format($pedido->total_pedido, 2) }}</p>

            <h3 class="text-xl font-semibold mt-6 mb-2">Productos</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
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
                            <td class="px-4 py-2">{{ $detalle->producto->nombre }}</td>
                            <td class="px-4 py-2">€ {{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td class="px-4 py-2">{{ $detalle->cantidad }}</td>
                            <td class="px-4 py-2">€ {{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex space-x-4">
                {{-- Botón entregar --}}
                @if($pedido->estado !== 'entregado' && $pedido->estado !== 'cancelado')
                    <form action="{{ route('cliente.pedidos.entregar', $pedido) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres marcar este pedido como entregado?');">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Marcar como entregado
                        </button>
                    </form>

                    {{-- Botón cancelar --}}
                    <form action="{{ route('cliente.pedidos.cancelar', $pedido) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres cancelar este pedido?');">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Cancelar pedido
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>
</x-layouts.layout>
