<x-layouts.layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    </div>

    <section>
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Bienvenido, {{ Auth::user()->name }}!</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 text-center">
                <div class="bg-blue-600 text-white rounded-xl p-4 shadow">
                    <h3 class="text-sm uppercase mb-1">Total de ventas</h3>
                    <p class="text-2xl font-bold">${{ number_format($totalVentas, 2) }}</p>
                </div>
                <div class="bg-green-600 text-white rounded-xl p-4 shadow">
                    <h3 class="text-sm uppercase mb-1">Cantidad de ventas</h3>
                    <p class="text-2xl font-bold">{{ $cantidadVentas }}</p>
                </div>
                <div class="bg-red-600 text-white rounded-xl p-4 shadow">
                    <h3 class="text-sm uppercase mb-1">Productos con bajo stock</h3>
                    <p class="text-2xl font-bold">{{ count($productosBajosStock) }}</p>
                </div>
            </div>

            <h3 class="text-xl font-semibold text-gray-700 mb-3">Últimas Ventas</h3>
            <ul class="divide-y divide-gray-200">
                @forelse ($ventasRecientes as $item)
                    <li class="flex justify-between items-center py-2">
                        <span class="text-gray-700">Venta #{{ $item->id }}</span>
                        <span class="bg-gray-300 text-gray-800 text-sm px-3 py-1 rounded-full">
              ${{ number_format($item->total_venta, 2) }}
            </span>
                    </li>
                @empty
                    <li class="text-gray-500 py-2">No hay ventas recientes</li>
                @endforelse
            </ul>
        </div>
    </section>
</x-layouts.layout>
