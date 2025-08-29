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

            // Crear pedido en BD
            $pedido = Pedido::create([
                'cliente_id'        => $session->metadata->user_id,
                'destinatario'      => $session->metadata->destinatario,
                'direccion_envio'   => $session->metadata->direccion_envio,
                'codigo_postal'     => $session->metadata->codigo_postal,
                'provincia'         => $session->metadata->provincia,
                'ciudad'            => $session->metadata->ciudad,
                'telefono_contacto' => $session->metadata->telefono_contacto,
                'estado'            => 'pagado',
                'metodo_pago'       => 'tarjeta',
                'total_pedido'      => $session->amount_total / 100,
                'stripe_session_id' => $session->id,
            ]);

            // Insertar detalles del pedido
            $carrito = session('carrito', []);
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
