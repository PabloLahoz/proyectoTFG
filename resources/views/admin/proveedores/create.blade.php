<x-layouts.layout>


<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Agregar proveedor</h1>
</div>

<section class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-semibold mb-4 text-gray-700">Agregar Nuevo Proveedor</h2>

    <form action="{{ route('admin.proveedores.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="nombre" class="block font-medium text-gray-700">Nombre de proveedor</label>
            <input type="text" name="nombre" id="nombre" required
                   class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label for="telefono" class="block font-medium text-gray-700">Teléfono</label>
            <input type="text" name="telefono" id="telefono" required
                   class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required
                   class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label for="direccion" class="block font-medium text-gray-700">Dirección</label>
            <input type="text" name="direccion" id="direccion" required
                   class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label for="notas" class="block font-medium text-gray-700">Notas</label>
            <textarea name="notas" id="notas" rows="4"
                      class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"></textarea>
        </div>

        <div class="flex gap-4 mt-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                Guardar
            </button>
            <a href="{{ route('admin.proveedores.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow">
                Cancelar
            </a>
        </div>
    </form>
</section>
</x-layouts.layout>
