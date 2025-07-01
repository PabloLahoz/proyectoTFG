<x-layouts.layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Catálogo de productos</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-center">
            @forelse($productos as $producto)
                <div class="card bg-base-100 w-96 shadow-sm">
                    <figure>
                        <img src="{{ asset('storage/' . $producto->imagen->ruta) }}" alt="{{ $producto->nombre }}" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $producto->nombre }}</h2>
                        <p class="font-semibold">€ {{ number_format($producto->precio_venta, 2) }}</p>

                        <form action="{{ route('carrito.añadir', $producto) }}" method="POST" class="mt-4">
                            @csrf
                            <input
                                type="number"
                                name="cantidad"
                                min="1"
                                value="1"
                                class="input input-bordered w-full"
                                required
                            />
                            <div class="card-actions justify-end mt-3">
                                <button type="submit" class="btn btn-primary w-full">Añadir a carrito</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">No hay productos disponibles.</p>
            @endforelse
        </div>
    </div>
</x-layouts.layout>
