<x-layouts.layout>
    <div class="max-w-4xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Tu carrito</h2>

        @if(session('success'))
            <div class="mb-4 text-green-700 bg-green-100 border border-green-200 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(count($carrito) > 0)
            <div class="space-y-4">
                @foreach($carrito as $item)
                    <div class="p-4 bg-white rounded shadow flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold">{{ $item['producto']->nombre }}</h3>
                            <p class="text-sm text-gray-600">Cantidad: {{ $item['cantidad'] }}</p>
                            <p class="text-sm text-gray-600">Precio unidad: €{{ number_format($item['producto']->precio_venta, 2) }}</p>
                        </div>
                        <p class="text-lg font-semibold">Subtotal: €{{ number_format($item['producto']->precio_venta * $item['cantidad'], 2) }}</p>
                    </div>
                @endforeach
            </div>

            <div class="text-right mt-6">
                <a href="{{ route('carrito.checkout') }}" class="btn btn-primary">Realizar pedido</a>
            </div>
        @else
            <p class="text-gray-600">Tu carrito está vacío.</p>
        @endif
    </div>
</x-layouts.layout>
