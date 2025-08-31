<?php

namespace App\Livewire;

use App\Models\DetallePedido;
use App\Models\Direccion;
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
    public $direccionSeleccionadaId = null;
    public $mostrarFormularioNuevaDireccion = false;
    public $direcciones = [];
    public $editandoDireccionId = null;
    public $alias;
    public $nuevo_destinatario;
    public $nueva_direccion;
    public $nuevo_codigo_postal;
    public $nueva_provincia;
    public $nueva_ciudad;
    public $nuevo_telefono;
    public $predeterminada = false;

    protected $listeners = ['redirect-to-checkout' => 'redirectToCheckout', 'direccionSeleccionada' => 'actualizarDireccionSeleccionada'];

    protected $rules = [
        'alias' => 'nullable|string|max:50',
        'nuevo_destinatario' => 'required|string|max:100',
        'nueva_direccion' => 'required|string|max:255',
        'nuevo_codigo_postal' => 'required|string|max:10',
        'nueva_provincia' => 'required|string|max:50',
        'nueva_ciudad' => 'required|string|max:50',
        'nuevo_telefono' => 'required|string|max:20',
        'predeterminada' => 'boolean'
    ];

    public function mount()
    {
        $carrito = session('carrito', []);
        $this->total = collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']);
        $this->cargarDirecciones();

        // Cargar dirección predeterminada si existe
        $direccionPredeterminada = Auth::user()->direccionPredeterminada;
        if ($direccionPredeterminada) {
            $this->cargarDireccion($direccionPredeterminada);
            $this->direccionSeleccionadaId = $direccionPredeterminada->id;
        }
    }

    public function cargarDirecciones()
    {
        $this->direcciones = Direccion::where('cliente_id', Auth::id())->get();
    }

    public function cargarDireccion($direccion)
    {
        $this->destinatario = $direccion->destinatario;
        $this->direccion_envio = $direccion->direccion;
        $this->codigo_postal = $direccion->codigo_postal;
        $this->provincia = $direccion->provincia;
        $this->ciudad = $direccion->ciudad;
        $this->telefono_contacto = $direccion->telefono;
    }

    public function updatedDireccionSeleccionadaId($id)
    {
        if ($id === 'nueva') {
            $this->mostrarFormularioNuevaDireccion = true;
            $this->resetFormularioDireccion();
        } elseif ($id) {
            $direccion = Auth::user()->direcciones()->find($id);
            if ($direccion) {
                $this->cargarDireccion($direccion);
                $this->mostrarFormularioNuevaDireccion = false;
            }
        }
    }

    public function toggleFormularioNuevaDireccion()
    {
        $this->mostrarFormularioNuevaDireccion = !$this->mostrarFormularioNuevaDireccion;
        $this->resetFormularioDireccion();
        $this->editandoDireccionId = null;
    }

    public function guardarNuevaDireccion()
    {
        $this->validate();

        $data = [
            'cliente_id' => Auth::id(),
            'alias' => $this->alias,
            'destinatario' => $this->nuevo_destinatario,
            'direccion' => $this->nueva_direccion,
            'codigo_postal' => $this->nuevo_codigo_postal,
            'provincia' => $this->nueva_provincia,
            'ciudad' => $this->nueva_ciudad,
            'telefono' => $this->nuevo_telefono,
            'predeterminada' => $this->predeterminada
        ];

        $direccion = Direccion::create($data);

        // Cargar la nueva dirección en el formulario
        $this->cargarDireccion($direccion);
        $this->direccionSeleccionadaId = $direccion->id;
        $this->mostrarFormularioNuevaDireccion = false;
        $this->cargarDirecciones();

        $this->resetFormularioDireccion();
    }

    public function editarDireccion($id)
    {
        $direccion = Direccion::findOrFail($id);
        $this->editandoDireccionId = $id;

        $this->alias = $direccion->alias;
        $this->nuevo_destinatario = $direccion->destinatario;
        $this->nueva_direccion = $direccion->direccion;
        $this->nuevo_codigo_postal = $direccion->codigo_postal;
        $this->nueva_provincia = $direccion->provincia;
        $this->nueva_ciudad = $direccion->ciudad;
        $this->nuevo_telefono = $direccion->telefono;
        $this->predeterminada = $direccion->predeterminada;

        $this->mostrarFormularioNuevaDireccion = true;
    }

    public function actualizarDireccion()
    {
        $this->validate();

        $direccion = Direccion::findOrFail($this->editandoDireccionId);

        $data = [
            'alias' => $this->alias,
            'destinatario' => $this->nuevo_destinatario,
            'direccion' => $this->nueva_direccion,
            'codigo_postal' => $this->nuevo_codigo_postal,
            'provincia' => $this->nueva_provincia,
            'ciudad' => $this->nueva_ciudad,
            'telefono' => $this->nuevo_telefono,
            'predeterminada' => $this->predeterminada
        ];

        $direccion->update($data);

        // Recargar y cerrar formulario
        $this->cargarDireccion($direccion);
        $this->mostrarFormularioNuevaDireccion = false;
        $this->editandoDireccionId = null;
        $this->cargarDirecciones();

        $this->resetFormularioDireccion();
    }

    public function cancelarEdicion()
    {
        $this->mostrarFormularioNuevaDireccion = false;
        $this->editandoDireccionId = null;
        $this->resetFormularioDireccion();

        // Mantener la selección actual si existe
        if ($this->direccionSeleccionadaId && $this->direccionSeleccionadaId !== 'nueva') {
            $direccion = Auth::user()->direcciones()->find($this->direccionSeleccionadaId);
            if ($direccion) {
                $this->cargarDireccion($direccion);
            }
        }
    }

    private function resetFormularioDireccion()
    {
        $this->reset([
            'alias', 'nuevo_destinatario', 'nueva_direccion',
            'nuevo_codigo_postal', 'nueva_provincia', 'nueva_ciudad',
            'nuevo_telefono', 'predeterminada', 'editandoDireccionId'
        ]);
    }

    public function actualizarDireccionSeleccionada($direccionId)
    {
        $this->direccionSeleccionadaId = $direccionId;

        if ($direccionId) {
            $direccion = Auth::user()->direcciones()->find($direccionId);
            if ($direccion) {
                $this->cargarDireccion($direccion);
            }
        }
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
                    'direccion_id' => $this->direccionSeleccionadaId,
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
