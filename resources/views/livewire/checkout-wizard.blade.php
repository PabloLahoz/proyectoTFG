<div class="max-w-3xl mx-auto p-6">
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

    {{-- Step 1: Dirección --}}
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

    {{-- Step 2: Pago (único con recuadro) --}}
    @if ($step === 2)
        <div class="space-y-6 border rounded-lg p-6 bg-gray-50 shadow-sm">
            <h3 class="text-lg font-semibold mb-4">💳 Datos de la tarjeta</h3>

            <div>
                <label class="block text-sm font-medium mb-1">Nombre en la tarjeta</label>
                <input type="text" wire:model="cardholder_name" class="w-full border rounded-lg p-2">
                @error('cardholder_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Número de tarjeta</label>
                <input type="text" wire:model="card_number" maxlength="16" placeholder="1234 1234 1234 1234" class="w-full border rounded-lg p-2">
                @error('card_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Expiración (MM)</label>
                    <input type="number" wire:model="card_exp_month" placeholder="MM" class="w-full border rounded-lg p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Expiración (YY)</label>
                    <input type="number" wire:model="card_exp_year" placeholder="YY" class="w-full border rounded-lg p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">CVC</label>
                    <input type="text" wire:model="card_cvv" maxlength="3" placeholder="123" class="w-full border rounded-lg p-2">
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <button type="button" wire:click="previousStep" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Atrás
                </button>
                <button type="button" wire:click="nextStep" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Siguiente
                </button>
            </div>
        </div>
    @endif

    {{-- Step 3: Confirmación --}}
    @if ($step === 3)
        <div class="space-y-6">
            <h3 class="text-lg font-semibold">Resumen del pedido</h3>

            <div class="space-y-2">
                <p><span class="font-medium">Destinatario:</span> {{ $destinatario }}</p>
                <p><span class="font-medium">Dirección:</span> {{ $direccion_envio }}, {{ $codigo_postal }} {{ $ciudad }} ({{ $provincia }})</p>
                <p><span class="font-medium">Teléfono:</span> {{ $telefono_contacto }}</p>
                <hr class="my-2">
                <p><span class="font-medium">Nombre en tarjeta:</span> Hola</p>
                <p><span class="font-medium">Número de tarjeta:</span> **** **** **** 4242</p>
            </div>

            <div class="text-right font-bold text-xl">
                Total a pagar: {{ number_format($total, 2) }} €
            </div>

            <div class="flex justify-between mt-6">
                <button type="button" wire:click="previousStep" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Atrás
                </button>
                <button type="button" wire:click="realizarPedido" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Confirmar y pagar {{ number_format($total, 2) }} €
                </button>
            </div>
        </div>
    @endif
</div>
