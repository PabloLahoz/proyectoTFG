<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Finalizar compra</h2>

    {{-- Mensajes --}}
    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Barra de progreso de pasos --}}
    <div class="flex justify-between mb-6">
        <div class="flex-1 text-center {{ $step === 1 ? 'font-bold text-blue-600' : '' }}">
            1. Dirección
        </div>
        <div class="flex-1 text-center {{ $step === 2 ? 'font-bold text-blue-600' : '' }}">
            2. Pago
        </div>
        <div class="flex-1 text-center {{ $step === 3 ? 'font-bold text-blue-600' : '' }}">
            3. Confirmación
        </div>
    </div>

    {{-- Paso 1: Dirección --}}
    @if ($step === 1)
        <div class="space-y-4">
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

            <div class="grid grid-cols-3 gap-4">
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

    {{-- Paso 2: Pago --}}
    @if ($step === 2)
        <div class="space-y-4">
            <div>
                <label class="block font-medium mb-1">Nombre en la tarjeta</label>
                <input type="text" wire:model="cardholder_name" class="w-full border p-2 rounded">
                @error('cardholder_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">Número de tarjeta</label>
                <input type="text" wire:model="card_number" maxlength="16" class="w-full border p-2 rounded">
                @error('card_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium mb-1">Mes expiración</label>
                    <input type="number" wire:model="card_exp_month" class="w-full border p-2 rounded">
                    @error('card_exp_month') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Año expiración</label>
                    <input type="number" wire:model="card_exp_year" class="w-full border p-2 rounded">
                    @error('card_exp_year') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">CVV</label>
                    <input type="text" wire:model="card_cvv" maxlength="3" class="w-full border p-2 rounded">
                    @error('card_cvv') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-between">
                <button type="button" wire:click="previousStep" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Atrás
                </button>
                <button type="button" wire:click="nextStep" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Siguiente
                </button>
            </div>
        </div>
    @endif

    {{-- Paso 3: Confirmación --}}
    @if ($step === 3)
        <div class="space-y-4">
            <h3 class="text-lg font-semibold">Confirmar pedido</h3>
            <p>Revise que todos los datos sean correctos antes de proceder con el pago.</p>

            <button type="button" wire:click="previousStep" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Atrás
            </button>
            <button type="button" wire:click="realizarPedido" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Confirmar y pagar {{ number_format($total, 2) }} €
            </button>
        </div>
    @endif
</div>
