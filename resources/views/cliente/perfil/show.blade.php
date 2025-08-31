<x-layouts.layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Mi Perfil</h2>

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
                          {{ request()->routeIs('cliente.perfil.show') ? 'bg-gray-200 text-gray-800 font-bold' : 'text-gray-700 hover:bg-gray-100' }}">
                        Datos
                    </a>
                </nav>
            </div>

            <!-- Contenido -->
            <div class="md:col-span-3 space-y-6">
                <!-- Sección de Datos -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Datos</h3>

                    <div class="mb-4">
                        <h4 class="text-md font-medium text-gray-800 mb-2">Nombre y apellidos</h4>
                        <p class="text-sm text-gray-900">{{ $cliente->name }}</p>
                        <p class="text-sm text-gray-600 mt-1">Correo electrónico</p>
                        <a href="mailto:{{ $cliente->email }}" class="text-sm text-blue-600 hover:underline">{{ $cliente->email }}</a>
                    </div>
                </div>

                <!-- Sección de Contraseña -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Contraseña</h3>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-900 mr-2">***********</span>
                    </div>
                </div>

                <!-- Sección de Cambiar contraseña -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Cambiar contraseña</h3>
                    <p class="text-sm text-gray-600 mb-4">Utiliza esta sección para cambiar tu contraseña de acceso.</p>
                    <a href="{{ route('cliente.perfil.password.edit') }}"
                       class="inline-flex justify-center rounded-md bg-yellow-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-yellow-600">
                        Cambiar contraseña
                    </a>
                </div>

                <!-- Botones de acción -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('cliente.perfil.edit') }}"
                       class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-indigo-700">
                        Actualizar datos
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
