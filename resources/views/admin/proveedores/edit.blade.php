<x-layouts.layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Editar proveedor</h1>
    </div>

    <section class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Editar Proveedor</h2>

        <form action="{{ route('admin.proveedores.update', $proveedor->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nombre" class="block font-medium text-gray-700">Nombre de proveedor</label>
                <input type="text" name="nombre" id="nombre" required value="{{ old('nombre', $proveedor->nombre) }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label for="telefono" class="block font-medium text-gray-700">Teléfono</label>
                <input type="text" name="telefono" id="telefono" required value="{{ old('telefono', $proveedor->telefono) }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required value="{{ old('email', $proveedor->email) }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label for="cp" class="block font-medium text-gray-700">CP</label>
                <input type="text" name="cp" id="cp" required value="{{ old('cp', $proveedor->cp) }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label for="sitio_web" class="block font-medium text-gray-700">Sitio Web</label>
                <input type="text" name="sitio_web" id="sitio_web" required value="{{ old('sitio_web', $proveedor->sitio_web) }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label for="notas" class="block font-medium text-gray-700">Notas</label>
                <textarea name="notas" id="notas" rows="4"
                          class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">{{ old('notas', $proveedor->notas) }}</textarea>
            </div>

            <div class="flex gap-4 mt-4">
                <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                    Actualizar
                </button>
                <a href="{{ route('admin.proveedores.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow">
                    Cancelar
                </a>
            </div>
        </form>
    </section>
</x-layouts.layout>
