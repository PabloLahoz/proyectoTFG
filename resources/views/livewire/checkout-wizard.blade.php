<div class="max-w-3xl mx-auto p-6">
    {{-- Mensajes --}}
    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Barra de progreso --}}
    <div class="flex justify-between mb-6">
        <div class="flex-1 text-center {{ $step === 1 ? 'font-bold text-blue-600' : '' }}">
            1. Dirección
        </div>
        <div class="flex-1 text-center {{ $step === 2 ? 'font-bold text-blue-600' : '' }}">
            2. Resumen
        </div>
        <div class="flex-1 text-center {{ $step === 3 ? 'font-bold text-blue-600' : '' }}">
            3. Pago
        </div>
    </div>

    {{-- Step 1: Selección de Dirección --}}
    @if ($step === 1)
        <div class="space-y-6">
            <h3 class="text-lg font-semibold text-gray-700">1. Selecciona una dirección de envío</h3>

            {{-- Lista de direcciones con radio buttons --}}
            @if ($direcciones->count() > 0)
                <div class="space-y-4">
                    <label class="block font-medium mb-2 text-gray-800">Tus direcciones guardadas:</label>

                    <div class="grid grid-cols-1 gap-3">
                        @foreach ($direcciones as $direccion)
                            <div class="border rounded-lg p-4 hover:border-blue-300 transition-colors
                                {{ $direccionSeleccionadaId == $direccion->id ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                                <div class="flex items-start space-x-3">
                                    <input type="radio"
                                           wire:model="direccionSeleccionadaId"
                                           value="{{ $direccion->id }}"
                                           id="direccion-{{ $direccion->id }}"
                                           class="mt-1 text-blue-600 focus:ring-blue-500">

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
                                                <div class="flex space-x-2">
                                                    <button wire:click="editarDireccion({{ $direccion->id }})"
                                                            class="text-blue-600 hover:text-blue-800 text-sm"
                                                            type="button">
                                                        Editar
                                                    </button>
                                                    @if (!$direccion->predeterminada)
                                                        <button wire:click="eliminarDireccion({{ $direccion->id }})"
                                                                class="text-red-600 hover:text-red-800 text-sm"
                                                                onclick="return confirm('¿Estás seguro de eliminar esta dirección?')"
                                                                type="button">
                                                            Eliminar
                                                        </button>
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
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Botón para añadir nueva dirección --}}
                <div class="mt-4">
                    <button wire:click="toggleFormularioNuevaDireccion"
                            class="flex items-center text-blue-600 hover:text-blue-800 font-medium">
                        <span class="text-xl mr-2">+</span>
                        Añadir otra dirección
                    </button>
                </div>

            @else
                {{-- Mensaje cuando no hay direcciones --}}
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                    <p class="text-blue-800 mb-3">No tienes direcciones guardadas.</p>
                    <button wire:click="toggleFormularioNuevaDireccion"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Crear mi primera dirección
                    </button>
                </div>
            @endif

            {{-- Formulario flotante para nueva/edición de dirección --}}
            @if ($mostrarFormularioNuevaDireccion)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md max-h-[90vh] overflow-y-auto">
                        <h4 class="text-lg font-semibold mb-4 text-gray-700">
                            {{ $editandoDireccionId ? 'Editar Dirección' : 'Nueva Dirección' }}
                        </h4>

                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium mb-1 text-gray-700">Alias (opcional)</label>
                                <input type="text" wire:model="alias" class="w-full border p-2 rounded text-gray-800"
                                       placeholder="Ej: Casa, Trabajo...">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1 text-gray-700">Destinatario *</label>
                                <input type="text" wire:model="nuevo_destinatario" class="w-full border p-2 rounded text-gray-800" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1 text-gray-700">Dirección *</label>
                                <input type="text" wire:model="nueva_direccion" class="w-full border p-2 rounded text-gray-800" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1 text-gray-700">Código Postal *</label>
                                <input type="text" wire:model="nuevo_codigo_postal" class="w-full border p-2 rounded text-gray-800" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1 text-gray-700">Provincia *</label>
                                <input type="text" wire:model="nueva_provincia" class="w-full border p-2 rounded text-gray-800" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1 text-gray-700">Ciudad *</label>
                                <input type="text" wire:model="nueva_ciudad" class="w-full border p-2 rounded text-gray-800" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1 text-gray-700">Teléfono *</label>
                                <input type="text" wire:model="nuevo_telefono" class="w-full border p-2 rounded text-gray-800" required>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" wire:model="predeterminada" id="predeterminada" class="mr-2">
                                <label for="predeterminada" class="text-gray-800">Establecer como dirección predeterminada</label>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 mt-6">
                            <button wire:click="cancelarEdicion" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                Cancelar
                            </button>
                            <button wire:click="{{ $editandoDireccionId ? 'actualizarDireccion' : 'guardarNuevaDireccion' }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                {{ $editandoDireccionId ? 'Actualizar' : 'Guardar' }}
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Botones de navegación --}}
            <div class="flex justify-between pt-6">
                <a href="{{ route('carrito.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    ← Volver al carrito
                </a>
                <button wire:click="nextStep"
                        @if (!$direccionSeleccionadaId) disabled @endif
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    Siguiente →
                </button>
            </div>
        </div>
    @endif

    {{-- Step 2: Resumen --}}
    @if ($step === 2)
        <div class="space-y-6">
            <h3 class="text-lg font-semibold text-gray-700">Resumen del pedido</h3>

            {{-- Dirección de envío --}}
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="font-medium text-gray-800 mb-2">📦 Dirección de envío:</h4>
                <div class="text-gray-700">
                    <p class="font-medium">{{ $destinatario }}</p>
                    <p>{{ $direccion_envio }}</p>
                    <p>{{ $codigo_postal }} {{ $ciudad }} ({{ $provincia }})</p>
                    <p>📞 {{ $telefono_contacto }}</p>
                </div>
            </div>

            {{-- Productos del carrito --}}
            <div class="bg-white border border-gray-200 rounded-lg">
                <h4 class="font-medium text-gray-800 p-4 border-b">Productos en el carrito:</h4>
                <div class="divide-y divide-gray-100">
                    @foreach(session('carrito', []) as $item)
                        <div class="p-3 flex justify-between items-center">
                            <div>
                                <span class="font-medium text-gray-900">{{ $item['nombre'] }}</span>
                                <span class="text-sm text-gray-600 ml-2">x{{ $item['cantidad'] }}</span>
                            </div>
                            <span class="font-medium text-gray-900">
                    {{ number_format($item['precio'] * $item['cantidad'], 2) }} €
                </span>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($stripeError)
                <div class="bg-red-100 text-red-700 p-3 rounded">
                    {{ $stripeError }}
                </div>
            @endif

            {{-- Botones de navegación --}}
            <div class="flex justify-between mt-6">
                <button type="button" wire:click="previousStep" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    ← Atrás
                </button>
                <button type="button" wire:click="nextStep" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Proceder al pago →
                </button>
            </div>
        </div>
    @endif

    {{-- Step 3: Redirección a Stripe --}}
    @if ($step === 3)
        <div class="text-center py-8">
            @if($checkoutUrl)
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Redirigiendo a Stripe Checkout...</h3>
                <p class="text-gray-600 mb-4 text-gray-800">Estamos preparando tu sesión de pago segura.</p>

                {{-- Redirección automática desde Livewire --}}
                <script>
                    // Pequeño delay para que el usuario vea el mensaje
                    setTimeout(function() {
                        // Forzar la redirección mediante Livewire
                        Livewire.dispatch('redirect-to-checkout');
                    }, 1500);
                </script>

                <div class="mt-6">
                    <p class="text-sm text-gray-500 mb-2">Si la redirección automática no funciona:</p>
                    <a href="{{ $checkoutUrl }}"
                       class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 inline-block">
                        Haz clic aquí para ir al pago
                    </a>
                </div>
            @else
                <div class="bg-red-100 text-red-700 p-3 rounded">
                    Error: No se pudo crear la sesión de pago. {{ $stripeError }}
                </div>
                <div class="mt-4">
                    <button wire:click="previousStep" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Volver atrás
                    </button>
                </div>
            @endif
        </div>
    @endif
</div>
