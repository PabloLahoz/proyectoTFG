<x-layouts.admin>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Error',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Proveedores</h1>

        <div class="bg-white shadow-md rounded-2xl p-6">
            <div class="mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                    <h2 class="text-2xl font-semibold text-gray-800">Listado de proveedores</h2>
                    <a href="{{ route('admin.proveedores.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-2xl hover:bg-blue-700 transition w-full md:w-auto text-center">
                        Nuevo proveedor
                    </a>
                </div>
                <p class="text-gray-500 mt-2">
                    Aquí puedes consultar, editar o eliminar proveedores registrados en el sistema.
                </p>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Teléfono</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Dirección</th>
                        <th class="px-4 py-2">Nota</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @foreach ($items as $item)
                        <tr class="hover:bg-gray-50 {{ $item->trashed() ? 'bg-gray-100 text-gray-500' : '' }}">
                            <td class="px-4 py-2 text-center">{{ $item->id }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->nombre }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->telefono }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->email }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->direccion }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->notas }}</td>
                            <td class="px-4 py-2 flex items-center gap-2 justify-center">
                                @if(!$item->trashed())
                                    {{-- Editar --}}
                                    <a href="{{ route('admin.proveedores.edit', $item) }}"
                                       class="bg-blue-600 text-white p-2 rounded-xl hover:bg-blue-800 transition">
                                        <x-heroicon-o-pencil-square class="w-5 h-5"/>
                                    </a>

                                    {{-- Desactivar --}}
                                    <form id="deleteForm{{$item->id}}"
                                          action="{{ route('admin.proveedores.destroy', $item->id) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                onclick="confirmDelete('deleteForm{{$item->id}}', '{{$item->nombre}}')"
                                                class="bg-red-500 text-white p-2 rounded-xl hover:bg-red-600 transition">
                                            <x-heroicon-o-trash class="w-5 h-5"/>
                                        </button>
                                    </form>
                                @else
                                    {{-- Reactivar --}}
                                    <form action="{{ route('admin.proveedores.restore', $item->id) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="bg-green-500 text-white p-2 rounded-xl hover:bg-green-600 transition">
                                            <x-heroicon-o-arrow-path class="w-5 h-5"/>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
