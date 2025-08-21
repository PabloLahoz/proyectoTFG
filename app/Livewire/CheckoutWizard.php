<?php

namespace App\Livewire;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutWizard extends Component
{
    public $destinatario;
    public $direccion_envio;
    public $codigo_postal;
    public $provincia;
    public $ciudad;
    public $telefono_contacto;

    public $step = 1;
    public $total;

    public function mount()
    {
        $carrito = session('carrito', []);
        $this->total = collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']);
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'destinatario' => 'required',
                'direccion_envio' => 'required',
                'codigo_postal' => 'required',
                'provincia' => 'required',
                'ciudad' => 'required',
                'telefono_contacto' => 'required',
            ]);
        }

        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function realizarPedido()
    {
        $user = Auth::user();
        $carrito = session('carrito', []);

        try {
            // Configurar Stripe
            Stripe::setApiKey(config('services.stripe.secret'));

            // Crear PaymentIntent con tarjeta
            $paymentIntent = PaymentIntent::create([
                'amount' => intval($this->total * 100), // céntimos
                'currency' => 'eur',
                'payment_method' => 'pm_card_visa',
                'confirm' => true,
                'confirmation_method' => 'manual',
                'return_url' => route('cliente.pedidos.index'),
            ]);

            // Comprobar si el pago fue aprobado
            if ($paymentIntent->status !== 'succeeded') {
                session()->flash('error', 'El pago no fue aprobado.');
                return;
            }

            // Crear pedido en BD
            $pedido = Pedido::create([
                'cliente_id'        => $user->id,
                'destinatario'      => $this->destinatario,
                'direccion_envio'   => $this->direccion_envio,
                'codigo_postal'     => $this->codigo_postal,
                'provincia'         => $this->provincia,
                'ciudad'            => $this->ciudad,
                'telefono_contacto' => $this->telefono_contacto,
                'estado'            => 'pagado', // ya queda pagado desde el inicio
                'metodo_pago'       => 'tarjeta',
                'total_pedido'      => $this->total,
            ]);

            // Insertar detalles de pedido y reducir stock
            foreach ($carrito as $item) {
                DetallePedido::create([
                    'pedido_id'      => $pedido->id,
                    'producto_id'    => $item['id'],
                    'cantidad'       => $item['cantidad'],
                    'precio_unitario'=> $item['precio'],
                ]);

                Producto::find($item['id'])->decrement('cantidad', $item['cantidad']);
            }

            // Vaciar carrito
            session()->forget('carrito');

            // Redirigir con mensaje de éxito
            return redirect()->route('cliente.pedidos.index')
                ->with('success', 'Pedido pagado y registrado con éxito.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error en el pago: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.checkout-wizard')
            ->layout('layouts.layout', ['titulo' => 'Checkout']);
    }
}
