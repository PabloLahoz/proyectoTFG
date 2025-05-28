<x-layouts.layout>
    <!-- Hero principal -->
    <section class="bg-cover bg-center h-[80vh] flex items-center justify-center text-white" style="background-image: url('/img/imagenInicio.jpg');">
        <div class="bg-black/60 p-8 rounded-xl text-center max-w-2xl">
            <h1 class="text-4xl font-bold mb-4">Tu proveedor de palets de confianza desde 1983</h1>
            <p class="text-lg mb-6">Consulta nuestro catálogo de palets y realiza pedidos de forma rápida y sencilla.</p>
            <a href="{{ route('catalogo') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-3 rounded-full font-semibold">
                Ver catálogo
            </a>
        </div>
    </section>

    <!-- Beneficios -->
    <section class="py-16 bg-white text-gray-800">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-10">¿Por qué elegirnos?</h2>
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <span class="text-yellow-500 text-4xl">🚚</span>
                    <h3 class="text-xl font-semibold mt-4">Entrega rápida</h3>
                    <p class="text-sm mt-2">Coordinamos el transporte según tus necesidades.</p>
                </div>
                <div>
                    <span class="text-yellow-500 text-4xl">🔁</span>
                    <h3 class="text-xl font-semibold mt-4">Palets reutilizados</h3>
                    <p class="text-sm mt-2">Ahorra costes y cuida el medio ambiente.</p>
                </div>
                <div>
                    <span class="text-yellow-500 text-4xl">📦</span>
                    <h3 class="text-xl font-semibold mt-4">Catálogo completo</h3>
                    <p class="text-sm mt-2">Palets europeos, americanos, especiales y más.</p>
                </div>
                <div>
                    <span class="text-yellow-500 text-4xl">📞</span>
                    <h3 class="text-xl font-semibold mt-4">Atención directa</h3>
                    <p class="text-sm mt-2">Trato personal para resolver tus necesidades.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos destacados -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-10">Productos destacados</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @forelse ($productos as $producto)
                    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-40 object-cover w-full mb-4 rounded">
                        <h3 class="text-xl font-semibold">{{ $producto->nombre }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $producto->material }} - {{ $producto->dimensiones }}</p>
                        <p class="text-lg font-bold text-yellow-600">{{ number_format($producto->precio_venta, 2) }} €</p>
                        <a href="" class="text-yellow-600 mt-4 inline-block hover:underline">Ver más</a>
                    </div>
                @empty
                    <p class="text-gray-500 text-center col-span-3">Actualmente no hay productos disponibles en el catálogo.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA final -->
    <section class="py-16 bg-yellow-500 text-center text-black">
        <h2 class="text-3xl font-bold mb-4">¿Necesitas palets para tu empresa?</h2>
        <p class="mb-6">Regístrate en nuestra plataforma y empieza a hacer tus pedidos online.</p>
        <a href="{{ route('register') }}" class="bg-black text-white px-6 py-3 rounded-full font-semibold hover:bg-gray-800">
            Registrarse
        </a>
    </section>
</x-layouts.layout>
