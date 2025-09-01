<x-layouts.layout :titulo="'{{ $producto->nombre }}'">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="card lg:card-side bg-base-100 shadow-lg bg-gray-50">
            <figure class="lg:w-1/2 p-4">
                <img
                    src="{{ Storage::disk('s3')->url($producto->imagen->ruta) }}"
                    alt="{{ $producto->nombre }}"
                    class="rounded-lg w-full aspect-square object-cover"
                />

            </figure>
            <div class="card-body lg:w-1/2">
                <h2 class="card-title text-2xl text-gray-700">{{ $producto->nombre }}</h2>

                <p class="text-gray-700">Material: {{ $producto->material }}</p>
                <p class="text-gray-700">Condición: {{ $producto->condicion }}</p>
                <p class="text-gray-700">Dimensiones: {{ $producto->dimensiones }}</p>

                <p class="text-lg font-semibold mt-2 text-green-600">
                    € {{ number_format($producto->precio_venta, 2) }}
                </p>

                <p class="text-sm text-gray-600">
                    Stock disponible: {{ $producto->cantidad }}
                </p>

                <form action="{{ route('carrito.añadir', $producto) }}" method="POST" class="mt-4">
                    @csrf
                    <label class="label" for="cantidad">
                        <span class="label-text">Cantidad:</span>
                    </label>
                    <input type="number" name="cantidad" min="1" value="1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800" required/>
                    <div class="card-actions justify-end mt-4">
                        <button type="submit" class="btn btn-primary w-full">Añadir al carrito</button>
                    </div>
                </form>

                <a href="{{ route('catalogo') }}" class="mt-4 text-sm text-blue-600 hover:underline">
                    ← Volver al catálogo
                </a>
            </div>
        </div>
    </div>
</x-layouts.layout>
