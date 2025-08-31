<x-layouts.layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar contraseña</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Menú lateral - Sin fondo blanco como solicitado -->
            <div class="p-4">
                <nav class="space-y-2">
                    <a href="{{ route('cliente.pedidos.index') }}"
                       class="block px-4 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('cliente.pedidos.index') ? 'bg-gray-200 text-gray-800 font-bold' : 'text-gray-700 hover:bg-gray-100' }}">
                        Pedidos
                    </a>
                    <a href="{{ route('cliente.direcciones.index') }}"
                       class="block px-4 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('cliente.pedidos.index') ? 'bg-gray-200 text-gray-800 font-bold' : 'text-gray-700 hover:bg-gray-100' }}">
                        Direcciones
                    </a>
                    <a href="{{ route('cliente.perfil.show') }}"
                       class="block px-4 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('cliente.perfil.password.edit') ? 'bg-gray-200 text-gray-800 font-bold' : 'text-gray-700 hover:bg-gray-100' }}">
                        Datos
                    </a>
                </nav>
            </div>

            <!-- Contenido -->
            <div class="md:col-span-3">
                <div class="bg-white shadow rounded-lg p-6">

                    <form method="POST" action="{{ route('cliente.perfil.password.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Contraseña actual -->
                        <div class="mb-4">
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Contraseña actual</label>
                            <input id="current_password" name="current_password" type="password" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-800 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('current_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Nueva contraseña -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
                            <input id="password" name="password" type="password" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-800 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Confirmar nueva contraseña -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar nueva contraseña</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-800 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <!-- Botones -->
                        <div class="mt-6 flex gap-3">
                            <button type="submit"
                                    class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-indigo-700">
                                Actualizar contraseña
                            </button>
                            <a href="{{ route('cliente.perfil.show') }}"
                               class="inline-flex justify-center rounded-md bg-gray-300 px-4 py-2 text-sm font-medium text-gray-700 shadow hover:bg-gray-400">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>
