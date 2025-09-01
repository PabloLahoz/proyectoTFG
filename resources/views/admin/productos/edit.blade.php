<x-layouts.admin :titulo="'Editar producto'">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white shadow-xl rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Editar producto</h2>

            <form action="{{ route('productos.update', $producto) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800">
                        @error('nombre')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Material</label>
                        <input type="text" name="material" value="{{ old('material', $producto->material) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800">
                        @error('material')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dimensiones</label>
                        <input type="text" name="dimensiones" value="{{ old('dimensiones', $producto->dimensiones) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800">
                        @error('dimensiones')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Condición</label>
                        <select name="condicion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800">
                            <option value="nuevo" {{ old('condicion', $producto->condicion) === 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                            <option value="seminuevo" {{ old('condicion', $producto->condicion) === 'seminuevo' ? 'selected' : '' }}>Seminuevo</option>
                        </select>
                        @error('condicion')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Precio de venta (€)</label>
                        <input type="number" step="0.01" name="precio_venta" value="{{ old('precio_venta', $producto->precio_venta) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800">
                        @error('precio_venta')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-6 flex justify-end gap-4">
                    <a href="{{ route('productos.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
