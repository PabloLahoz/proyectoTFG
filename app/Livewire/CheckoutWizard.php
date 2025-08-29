<?php

namespace App\Livewire;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

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
    public $checkoutUrl;
    public $stripeError;
    public $shouldRedirect = false;

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

        if ($this->step === 2) {
            $this->createCheckoutSession();
            return; // No incrementar step todavía
        }

        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function createCheckoutSession()
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $lineItems = [];
            $carrito = session('carrito', []);

            foreach ($carrito as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item['nombre'],
                        ],
                        'unit_amount' => intval($item['precio'] * 100),
                    ],
                    'quantity' => $item['cantidad'],
                ];
            }

            if (empty($lineItems)) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Pedido',
                        ],
                        'unit_amount' => intval($this->total * 100),
                    ],
                    'quantity' => 1,
                ];
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
                'customer_email' => Auth::user()->email,
                'metadata' => [
                    'user_id' => Auth::id(),
                    'destinatario' => $this->destinatario,
                    'direccion_envio' => $this->direccion_envio,
                    'codigo_postal' => $this->codigo_postal,
                    'provincia' => $this->provincia,
                    'ciudad' => $this->ciudad,
                    'telefono_contacto' => $this->telefono_contacto,
                ],
            ]);

            $this->checkoutUrl = $session->url;
            $this->shouldRedirect = true;
            $this->step = 3; // Ahora sí avanzamos al paso 3

        } catch (ApiErrorException $e) {
            $this->stripeError = 'Error al crear la sesión de pago: ' . $e->getMessage();
            \Log::error('Stripe Checkout Error: ' . $e->getMessage());
        }
    }

    protected $listeners = ['redirect-to-checkout' => 'redirectToCheckout'];
    public function redirectToCheckout()
    {
        if ($this->checkoutUrl) {
            return redirect()->away($this->checkoutUrl);
        }

        $this->stripeError = 'No hay URL de checkout disponible';
        $this->step = 2; // Volver al paso anterior
    }

    public function render()
    {
        // Redirigir automáticamente si shouldRedirect es true
        if ($this->shouldRedirect && $this->checkoutUrl) {
            $this->redirectToCheckout();
        }

        return view('livewire.checkout-wizard')
            ->layout('layouts.layout', ['titulo' => 'Checkout']);
    }
}
