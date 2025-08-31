<x-layouts.admin>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white shadow-xl rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Crear nuevo producto</h2>

            <form action="{{ route('admin.productos.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-800 focus:ring-blue-500 focus:border-blue-500">
                        @error('nombre')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Material</label>
                        <input type="text" name="material" value="{{ old('material') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-800 focus:ring-blue-500 focus:border-blue-500">
                        @error('material')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dimensiones</label>
                        <input type="text" name="dimensiones" value="{{ old('dimensiones') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-800 focus:ring-blue-500 focus:border-blue-500">
                        @error('dimensiones')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Condición</label>
                        <select name="condicion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-800 focus:ring-blue-500 focus:border-blue-500">
                            <option value="nuevo" {{ old('condicion') === 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                            <option value="seminuevo" {{ old('condicion') === 'seminuevo' ? 'selected' : '' }}>Seminuevo</option>
                        </select>
                        @error('estado')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
                        <input type="file" id="imagen" name="imagen"
                               class="mt-1 block w-full border-gray-300 shadow-sm text-gray-800 rounded-lg focus:ring focus:ring-blue-200">
                        @error('imagen')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row justify-end gap-4">
                    <a href="{{ route('admin.productos.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-2xl hover:bg-gray-300 transition text-center">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
