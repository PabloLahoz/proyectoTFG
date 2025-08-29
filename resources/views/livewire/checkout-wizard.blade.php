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

    {{-- Step 1: Dirección --}}
    @if ($step === 1)
        <div class="space-y-4">
            <!-- ... (formulario de dirección) ... -->
            <div>
                <label class="block font-medium mb-1">Destinatario</label>
                <input type="text" wire:model="destinatario" class="w-full border p-2 rounded">
                @error('destinatario') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Dirección de envío</label>
                <input type="text" wire:model="direccion_envio" class="w-full border p-2 rounded">
                @error('direccion_envio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Código Postal</label>
                <input type="text" wire:model="codigo_postal" class="w-full border p-2 rounded">
                @error('codigo_postal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Provincia</label>
                <input type="text" wire:model="provincia" class="w-full border p-2 rounded">
                @error('provincia') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Ciudad</label>
                <input type="text" wire:model="ciudad" class="w-full border p-2 rounded">
                @error('ciudad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Teléfono de contacto</label>
                <input type="text" wire:model="telefono_contacto" class="w-full border p-2 rounded">
                @error('telefono_contacto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end">
                <button type="button" wire:click="nextStep" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Siguiente
                </button>
            </div>
        </div>
    @endif

    {{-- Step 2: Resumen --}}
    @if ($step === 2)
        <div class="space-y-6">
            <h3 class="text-lg font-semibold">Resumen del pedido</h3>

            <div class="space-y-2">
                <p><span class="font-medium">Destinatario:</span> {{ $destinatario }}</p>
                <p><span class="font-medium">Dirección:</span> {{ $direccion_envio }}, {{ $codigo_postal }} {{ $ciudad }} ({{ $provincia }})</p>
                <p><span class="font-medium">Teléfono:</span> {{ $telefono_contacto }}</p>
            </div>

            <div class="text-right font-bold text-xl">
                Total a pagar: {{ number_format($total, 2) }} €
            </div>

            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">
                <p class="font-bold">Modo de prueba</p>
                <p>Serás redirigido a Stripe Checkout para realizar el pago de prueba</p>
                <p>Usa: <strong>4242 4242 4242 4242</strong> - Fecha futura - CVC 123</p>
            </div>

            @if($stripeError)
                <div class="bg-red-100 text-red-700 p-3 rounded">
                    {{ $stripeError }}
                </div>
            @endif

            <div class="flex justify-between mt-6">
                <button type="button" wire:click="previousStep" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Atrás
                </button>
                <button type="button" wire:click="nextStep" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Proceder al pago
                </button>
            </div>
        </div>
    @endif

    {{-- Step 3: Redirección a Stripe --}}
    @if ($step === 3)
        <div class="text-center py-8">
            @if($checkoutUrl)
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                <h3 class="text-lg font-semibold mb-2">Redirigiendo a Stripe Checkout...</h3>
                <p class="text-gray-600 mb-4">Estamos preparando tu sesión de pago segura.</p>

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
