<x-layouts.layout>
    <!-- HERO / CABECERA PRINCIPAL -->
    <section class="bg-blue-100 text-center py-16">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Bienvenido a Palets Épila</h1>
        <p class="text-gray-700 text-lg mb-6">Especialistas en productos de madera de calidad al mejor precio.</p>
        <a href="{{ route('productos.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Ver productos</a>
    </section>

    <!-- PRODUCTOS DESTACADOS -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Productos destacados</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($productos as $producto)
                <div class="bg-white shadow rounded p-4 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $producto->nombre }}</h3>
                        <p class="text-gray-600">{{ $producto->material }} · {{ $producto->dimensiones }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="text-blue-600 font-bold text-lg">{{ number_format($producto->precio_venta, 2) }} €</p>
                        <a href="{{ route('productos.show', $producto) }}" class="text-blue-500 hover:underline text-sm mt-2 inline-block">Ver más</a>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-600">No hay productos disponibles por ahora.</p>
            @endforelse
        </div>
    </section>

    <!-- SECCIÓN SOBRE NOSOTROS -->
    <section class="bg-gray-100 py-12 px-6 text-center">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Sobre nosotros</h2>
        <p class="max-w-3xl mx-auto text-gray-700">En Palets Épila llevamos más de 20 años dedicándonos a la venta de productos de madera. Nos especializamos en ofrecer soluciones sostenibles y económicas tanto a pequeñas empresas como a grandes distribuidores.</p>
    </section>

    <!-- LLAMADA A LA ACCIÓN -->
    <section class="py-12 text-center">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">¿Tienes dudas o necesitas un presupuesto?</h2>
        <a href="{{ route('contacto') }}" class="inline-block mt-4 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Contáctanos</a>
    </section>
</x-layouts.layout>
