<x-layouts.admin>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Editar proveedor</h1>
    </div>

    <section class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Editar Proveedor</h2>

        <form action="{{ route('admin.proveedores.update', $proveedor) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nombre" class="block font-medium text-gray-700">Nombre de proveedor</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $proveedor->nombre) }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 text-gray-800">
                @error('nombre')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="telefono" class="block font-medium text-gray-700">Teléfono</label>
                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $proveedor->telefono) }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 text-gray-800">
                @error('telefono')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $proveedor->email) }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 text-gray-800">
                @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="direccion" class="block font-medium text-gray-700">Dirección</label>
                <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $proveedor->direccion) }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 text-gray-800">
                @error('direccion')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="notas" class="block font-medium text-gray-700">Notas</label>
                <textarea name="notas" id="notas" rows="4"
                          class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 text-gray-800">{{ old('notas', $proveedor->notas) }}</textarea>
                @error('notas')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
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
</x-layouts.admin>
