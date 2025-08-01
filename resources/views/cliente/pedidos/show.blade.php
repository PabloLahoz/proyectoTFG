<x-layouts.layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-xl rounded-2xl p-6">
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

            <a href="{{ route('cliente.pedidos.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">← Volver al listado</a>
        </div>
    </div>
</x-layouts.layout>
