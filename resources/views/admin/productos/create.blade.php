<x-layouts.layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white shadow-xl rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Crear nuevo producto</h2>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-200 text-red-700 px-4 py-2 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('productos.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Material</label>
                        <input type="text" name="material" value="{{ old('material') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dimensiones</label>
                        <input type="text" name="dimensiones" value="{{ old('dimensiones') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="nuevo" {{ old('estado') === 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                            <option value="seminuevo" {{ old('estado') === 'seminuevo' ? 'selected' : '' }}>Seminuevo</option>
                        </select>
                    </div>
                </div>

                <div class="pt-6 flex justify-end gap-4">
                    <a href="{{ route('admin.productos.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.layout>
