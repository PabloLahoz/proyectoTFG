<x-layouts.layout>
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Carrito de compras</h1>

        @if(session('success'))
            <div class="mb-4 text-green-700 bg-green-100 border border-green-200 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @php
            $carrito = session('carrito', []);
        @endphp

        @if(empty($carrito))
            <p class="text-gray-500">Tu carrito está vacío.</p>
        @else
            <div class="mb-4 flex justify-end">
                <form action="{{ route('carrito.vaciar') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-error btn-sm" onclick="return confirm('¿Estás seguro de vaciar el carrito?')">Vaciar carrito</button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow">
                    <thead class="bg-gray-100 text-left text-sm text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Imagen</th>
                        <th class="px-4 py-2">Producto</th>
                        <th class="px-4 py-2">Precio</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Subtotal</th>
                        <th class="px-4 py-2">Acción</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                    @php $total = 0; @endphp
                    @foreach($carrito as $id => $producto)
                        @php
                            $subtotal = $producto['precio'] * $producto['cantidad'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="px-4 py-3">
                                @if($producto['imagen'])
                                    <a href="{{ route('catalogo.show', $producto['id']) }}">
                                        <img src="{{ asset('storage/' . $producto['imagen']['ruta']) }}" alt="{{ $producto['nombre'] }}" class="w-16 h-16 object-cover rounded" />
                                    </a>
                                @else
                                    <span class="text-gray-400">Sin imagen</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $producto['nombre'] }}</td>
                            <td class="px-4 py-3">€{{ number_format($producto['precio'], 2) }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('carrito.actualizar', $id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="cantidad" value="{{ $producto['cantidad'] }}" min="1" class="input input-bordered input-sm w-20" required>
                                    <button type="submit" class="btn btn-sm btn-outline btn-info">Actualizar</button>
                                </form>
                            </td>
                            <td class="px-4 py-3">€{{ number_format($subtotal, 2) }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('carrito.eliminar', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline btn-error" onclick="return confirm('¿Eliminar este producto del carrito?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-50 font-semibold">
                        <td colspan="4" class="px-4 py-3 text-right">Total:</td>
                        <td class="px-4 py-3">€{{ number_format($total, 2) }}</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-right">
                <a href="" class="btn btn-primary">Realizar pedido</a>
            </div>
        @endif
    </div>
</x-layouts.layout>
