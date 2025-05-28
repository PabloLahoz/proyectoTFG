<x-layouts.layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Hacer una compra</h1>
    </div>

    <section class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">
            Nueva compra
        </h2>

        <form action="{{ route('admin.compras.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" value="{{ $item->id }}" id="id" name="id">

            <div>
                <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad del producto</label>
                <input type="text" name="cantidad" id="cantidad" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="precio_compra" class="block text-sm font-medium text-gray-700">Precio de compra</label>
                <input type="text" name="precio_compra" id="precio_compra" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="flex gap-4 mt-6">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow">
                    Comprar
                </button>
                <a href="{{ route('productos') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md shadow">
                    Cancelar
                </a>
            </div>
        </form>
    </section>
</x-layouts.layout>
