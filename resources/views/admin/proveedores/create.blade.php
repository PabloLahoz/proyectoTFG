<x-layouts.admin>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <section class="bg-white p-6 rounded-2xl shadow-xl">
            <h2 class="text-2xl font-semibold mb-6 text-gray-700">Agregar Nuevo Proveedor</h2>

            <form action="{{ route('admin.proveedores.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nombre" class="block font-medium text-gray-700">Nombre de proveedor</label>
                        <input type="text" name="nombre" id="nombre" required
                               class="mt-1 block w-full border-gray-300 shadow-sm text-gray-800 rounded-lg focus:ring focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="telefono" class="block font-medium text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" required
                               class="mt-1 block w-full border-gray-300 shadow-sm text-gray-800 rounded-lg focus:ring focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="email" class="block font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required
                               class="mt-1 block w-full border-gray-300 shadow-sm text-gray-800 rounded-lg focus:ring focus:ring-blue-200">
                    </div>

                    <div>
                        <label for="direccion" class="block font-medium text-gray-700">Dirección</label>
                        <input type="text" name="direccion" id="direccion" required
                               class="mt-1 block w-full border-gray-300 shadow-sm text-gray-800 rounded-lg focus:ring focus:ring-blue-200">
                    </div>
                </div>

                <div>
                    <label for="notas" class="block font-medium text-gray-700">Notas</label>
                    <textarea name="notas" id="notas" rows="4"
                              class="mt-1 block w-full border-gray-300 shadow-sm text-gray-800 rounded-lg focus:ring focus:ring-blue-200"></textarea>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row justify-end gap-4">
                    <a href="{{ route('admin.proveedores.index') }}"
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
