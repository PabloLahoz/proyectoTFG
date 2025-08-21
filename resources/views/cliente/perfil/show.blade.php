<x-layouts.layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Mi Perfil</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Menú lateral -->
            <div class="bg-white shadow rounded-lg p-4">
                <nav class="space-y-2">
                    <a href="{{ route('cliente.perfil.show') }}"
                       class="block px-4 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('cliente.perfil.show') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Perfil
                    </a>
                    <a href="{{ route('cliente.pedidos.index') }}"
                       class="block px-4 py-2 rounded-md text-sm font-medium
                          {{ request()->routeIs('cliente.pedidos.index') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Mis pedidos
                    </a>
                </nav>
            </div>

            <!-- Contenido -->
            <div class="md:col-span-3">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Información del usuario</h3>
                    <dl class="divide-y divide-gray-200">
                        <div class="py-3 flex justify-between">
                            <dt class="text-sm font-medium text-gray-600">Nombre y apellidos</dt>
                            <dd class="text-sm text-gray-900">{{ $cliente->name }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="text-sm font-medium text-gray-600">Empresa</dt>
                            <dd class="text-sm text-gray-900">{{ $cliente->empresa }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="text-sm font-medium text-gray-600">Email</dt>
                            <dd class="text-sm text-gray-900">{{ $cliente->email }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('cliente.perfil.edit') }}"
                       class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-indigo-700">
                        Actualizar datos
                    </a>

                    <a href="{{ route('cliente.perfil.password.edit') }}"
                       class="inline-flex justify-center rounded-md bg-yellow-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-yellow-600">
                        Cambiar contraseña
                    </a>

                    <form action="{{ route('cliente.perfil.cerrar') }}" method="POST"
                          onsubmit="return confirm('¿Seguro que quieres cerrar tu cuenta?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="inline-flex justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-red-700">
                            Cerrar cuenta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>
