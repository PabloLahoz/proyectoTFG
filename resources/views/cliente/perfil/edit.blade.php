<x-layouts.layout>
    <div class="max-w-2xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar mis datos</h2>

        <div class="bg-white shadow rounded-lg p-6">
            <form method="POST" action="{{ route('cliente.perfil.update') }}">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre y apellidos</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $cliente->name) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Empresa -->
                <div class="mb-4">
                    <label for="empresa" class="block text-sm font-medium text-gray-700">Empresa</label>
                    <input id="empresa" name="empresa" type="text" value="{{ old('empresa', $cliente->empresa) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('empresa') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $cliente->email) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Botones -->
                <div class="mt-6 flex gap-3">
                    <button type="submit"
                            class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-indigo-700">
                        Guardar cambios
                    </button>
                    <a href="{{ route('cliente.perfil.show') }}"
                       class="inline-flex justify-center rounded-md bg-gray-300 px-4 py-2 text-sm font-medium text-gray-700 shadow hover:bg-gray-400">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.layout>
