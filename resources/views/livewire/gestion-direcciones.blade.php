<div class="space-y-6">
    {{-- Título diferente según el modo --}}
    @if (!$this->modoCheckout)
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">Mis Direcciones</h2>
            <button wire:click="nuevaDireccion" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                ＋ Nueva Dirección
            </button>
        </div>
    @else
        <h3 class="text-lg font-semibold">Selecciona una dirección de envío</h3>
    @endif

    {{-- Mensajes --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Formulario Modal --}}
    @if ($mostrarFormulario)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md max-h-[90vh] overflow-y-auto">
                <h3 class="text-lg font-semibold mb-4">
                    {{ $editandoId ? 'Editar Dirección' : 'Nueva Dirección' }}
                </h3>

                <form wire:submit.prevent="guardarDireccion">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Alias (opcional)</label>
                            <input type="text" wire:model="alias" class="w-full border p-2 rounded"
                                   placeholder="Ej: Casa, Trabajo...">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Destinatario *</label>
                            <input type="text" wire:model="destinatario" class="w-full border p-2 rounded" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Dirección *</label>
                            <input type="text" wire:model="direccion" class="w-full border p-2 rounded" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Código Postal *</label>
                            <input type="text" wire:model="codigo_postal" class="w-full border p-2 rounded" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Provincia *</label>
                            <input type="text" wire:model="provincia" class="w-full border p-2 rounded" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Ciudad *</label>
                            <input type="text" wire:model="ciudad" class="w-full border p-2 rounded" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Teléfono *</label>
                            <input type="text" wire:model="telefono" class="w-full border p-2 rounded" required>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" wire:model="predeterminada" id="predeterminada" class="mr-2">
                            <label for="predeterminada">Establecer como dirección predeterminada</label>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" wire:click="cancelar" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            {{ $editandoId ? 'Actualizar' : 'Crear' }} Dirección
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Lista de Direcciones --}}
    @if ($direcciones->count() > 0)
        <div class="space-y-3">
            @foreach ($direcciones as $direccion)
                <div class="border rounded-lg p-4 hover:border-blue-300 transition-colors
                            {{ $this->modoCheckout && $direccionSeleccionadaId == $direccion->id ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}
                            {{ $direccion->predeterminada ? 'border-blue-300' : '' }}">

                    <div class="flex items-start space-x-3">
                        {{-- Radio button solo en modo checkout --}}
                        @if ($this->modoCheckout)
                            <input type="radio"
                                   wire:model="direccionSeleccionadaId"
                                   value="{{ $direccion->id }}"
                                   id="direccion-{{ $direccion->id }}"
                                   class="mt-1 text-blue-600 focus:ring-blue-500">
                        @endif

                        <div class="flex-1">
                            <label for="direccion-{{ $direccion->id }}" class="block cursor-pointer">
                                <div class="flex items-center justify-between">
                                    <div>
                                        @if ($direccion->predeterminada)
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded mr-2">
                                                Predeterminada
                                            </span>
                                        @endif
                                        @if ($direccion->alias)
                                            <span class="font-semibold text-gray-900">{{ $direccion->alias }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-gray-700 mt-2">
                                    <p class="font-medium">{{ $direccion->destinatario }}</p>
                                    <p>{{ $direccion->direccion }}</p>
                                    <p>{{ $direccion->codigo_postal }} {{ $direccion->ciudad }}</p>
                                    <p>{{ $direccion->provincia }}</p>
                                    <p class="mt-1">📞 {{ $direccion->telefono }}</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Botones de acción --}}
                    <div class="flex space-x-3 mt-4 pt-3 border-t border-gray-100">
                        <button wire:click="editarDireccion({{ $direccion->id }})"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Editar
                        </button>
                        @if (!$direccion->predeterminada)
                            <button wire:click="eliminarDireccion({{ $direccion->id }})"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium"
                                    onclick="return confirm('¿Estás seguro de eliminar esta dirección?')">
                                Eliminar
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Botón para añadir en modo checkout --}}
        @if ($this->modoCheckout)
            <div class="border border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-300 transition-colors">
                <button wire:click="nuevaDireccion"
                        class="text-blue-600 hover:text-blue-800 flex items-center justify-center w-full">
                    <span class="text-lg">➕</span>
                    <span class="ml-2">Añadir otra dirección</span>
                </button>
            </div>
        @endif

    @else
        {{-- Mensaje cuando no hay direcciones --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
            <p class="text-blue-800 mb-3">No tienes direcciones guardadas.</p>
            <button wire:click="nuevaDireccion" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Crear mi primera dirección
            </button>
        </div>
    @endif

    {{-- Botón para añadir en modo perfil (cuando hay direcciones) --}}
    @if (!$this->modoCheckout && $direcciones->count() > 0)
        <div class="border border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-300 transition-colors">
            <button wire:click="nuevaDireccion"
                    class="text-blue-600 hover:text-blue-800 flex items-center justify-center w-full">
                <span class="text-lg">➕</span>
                <span class="ml-2">Añadir otra dirección</span>
            </button>
        </div>
    @endif
</div>
