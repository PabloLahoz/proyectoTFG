<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeCheckoutController extends Controller
{
    public function success(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $session = Session::retrieve($request->session_id);

            if ($session->payment_status !== 'paid') {
                return redirect()->route('checkout.cancel')
                    ->with('error', 'El pago no fue realizado');
            }

            // 1. Obtener datos del metadata
            $userId = $session->metadata->user_id;
            $direccionId = $session->metadata->direccion_id;

            // 2. Obtener carrito y calcular total
            $carrito = session('carrito', []);
            $total = collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']);

            // Crear pedido en BD
            $pedido = Pedido::create([
                'cliente_id'        => $userId,
                'direccion_id'      => $direccionId,
                'estado'            => 'pagado',
                'metodo_pago'       => 'tarjeta',
                'total_pedido'      => $total,
                'stripe_session_id' => $session->id,
                'stripe_payment_id' => $session->payment_intent,
                'fecha_pedido'      => now(),
            ]);

            // Insertar detalles del pedido
            foreach ($carrito as $item) {
                DetallePedido::create([
                    'pedido_id'      => $pedido->id,
                    'producto_id'    => $item['id'],
                    'cantidad'       => $item['cantidad'],
                    'precio_unitario'=> $item['precio'],
                ]);

                // Reducir stock
                $producto = Producto::find($item['id']);
                if ($producto) {
                    $producto->cantidad -= $item['cantidad'];
                    $producto->save();
                }
            }

            // Vaciar carrito
            session()->forget('carrito');

            return redirect()->route('cliente.pedidos.index')
                ->with('success', '¡Pedido pagado y registrado con éxito!');

        } catch (\Exception $e) {
            \Log::error('Checkout Success Error: ' . $e->getMessage());
            return redirect()->route('checkout.cancel')
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        return redirect()->route('checkout-wizard')
            ->with('error', 'Pago cancelado. Puedes intentarlo de nuevo.');
    }
}
