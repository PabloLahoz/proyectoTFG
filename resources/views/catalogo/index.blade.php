<x-layouts.layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Catálogo de productos</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($productos as $producto)
                <div class="card bg-gray-50 shadow-lg rounded-lg overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">

                    <figure class="w-full aspect-square overflow-hidden">
                        <a href="{{ route('catalogo.show', $producto) }}">
                            <img
                                src="{{ asset('storage/' . $producto->imagen->ruta) }}"
                                alt="{{ $producto->nombre }}"
                                class="w-full h-full object-cover hover:opacity-80 transition duration-200"
                            />
                        </a>
                    </figure>

                    <div class="card-body p-4">
                        <h2 class="card-title text-lg font-semibold mb-2 text-gray-700">{{ $producto->nombre }}</h2>
                        <p class="font-semibold text-gray-800 text-xl mb-4">€ {{ number_format($producto->precio_venta, 2) }}</p>
                        <p class="font-semibold text-gray-800 text-md mb-4">Stock: {{$producto->cantidad}}</p>

                        <form action="{{ route('carrito.añadir', $producto) }}" method="POST" class="mt-2">
                            @csrf
                            <div class="mb-3">
                                <input type="number" name="cantidad" min="1" value="1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800" required/>
                            </div>
                            <div class="card-actions">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition duration-200">
                                    Añadir a carrito
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500 py-10">No hay productos disponibles.</p>
            @endforelse
        </div>
    </div>
</x-layouts.layout>
