<x-layouts.admin>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <section class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">
                Nueva compra
            </h2>

            <form action="{{ route('admin.compras.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Lista desplegable de productos --}}
                    <div>
                        <label for="producto_id" class="block text-sm font-medium text-gray-700">Producto</label>
                        <select name="producto_id" id="producto_id"
                                class="mt-1 block w-full border-gray-300 shadow-sm text-gray-800 rounded-lg focus:ring focus:ring-blue-200">
                            <option value="">Seleccione un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                    {{ $producto->id }} - {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('producto_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Lista desplegable de proveedores --}}
                    <div>
                        <label for="proveedor_id" class="block text-sm font-medium text-gray-700">Proveedor</label>
                        <select name="proveedor_id" id="proveedor_id"
                                class="mt-1 block w-full border-gray-300 shadow-sm text-gray-800 rounded-lg focus:ring focus:ring-blue-200">
                            <option value="">Seleccione un proveedor</option>
                            @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                    {{ $proveedor->id }} - {{ $proveedor->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('proveedor_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad del producto</label>
                        <input type="text" name="cantidad" id="cantidad" value="{{ old('cantidad') }}"
                               class="mt-1 block w-full border-gray-300 shadow-sm text-gray-800 rounded-lg focus:ring focus:ring-blue-200">
                        @error('cantidad')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="precio_compra" class="block text-sm font-medium text-gray-700">Precio de compra</label>
                        <input type="text" name="precio_compra" id="precio_compra" value="{{ old('precio_compra') }}"
                               class="mt-1 block w-full border-gray-300 shadow-sm text-gray-800 rounded-lg focus:ring focus:ring-blue-200">
                        @error('precio_compra')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row justify-end gap-4">
                    <a href="{{ route('admin.compras.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-2xl hover:bg-gray-300 transition text-center">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 transition">
                        Guardar
                    </button>
                </div>

            </form>
        </section>
    </div>
</x-layouts.admin>
