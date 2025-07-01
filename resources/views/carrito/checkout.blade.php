<x-layouts.layout>
    <div class="max-w-2xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Confirmar Pedido</h2>

        <form action="{{ route('carrito.realizarPedido') }}" method="POST" id="checkout-form">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-1">Dirección de envío:</label>
                <input type="text" name="direccion_envio" required class="input input-bordered w-full" />
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Método de pago:</label>
                <select name="metodo_pago" id="metodo_pago" class="select select-bordered w-full">
                    <option value="tarjeta">Tarjeta</option>
                    <option value="transferencia">Transferencia</option>
                </select>
            </div>

            <div id="pago_tarjeta" class="mb-4">
                <label class="block font-medium mb-1">Titular:</label>
                <input type="text" name="titular" class="input input-bordered w-full" />

                <label class="block font-medium mb-1 mt-2">Número de tarjeta:</label>
                <input type="text" name="tarjeta" class="input input-bordered w-full" />

                <label class="block font-medium mb-1 mt-2">Fecha caducidad:</label>
                <input type="text" name="caducidad" placeholder="MM/AA" class="input input-bordered w-full" />
            </div>

            <div id="pago_transferencia" class="mb-4 hidden">
                <p>Número de cuenta: <strong>ES12 3456 7890 1234 5678 9012</strong></p>
                <p>Asunto: <strong>Pedido de {{ Auth::user()->name }}</strong></p>
            </div>

            <button type="submit" class="btn btn-success w-full">Pagar</button>
        </form>
    </div>

    <script>
        const metodoPago = document.getElementById('metodo_pago');
        const tarjeta = document.getElementById('pago_tarjeta');
        const transferencia = document.getElementById('pago_transferencia');

        metodoPago.addEventListener('change', () => {
            if (metodoPago.value === 'tarjeta') {
                tarjeta.classList.remove('hidden');
                transferencia.classList.add('hidden');
            } else {
                tarjeta.classList.add('hidden');
                transferencia.classList.remove('hidden');
            }
        });
    </script>
</x-layouts.layout>
