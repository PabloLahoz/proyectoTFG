<?php

namespace App\Livewire;

use App\Models\Direccion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GestionDirecciones extends Component
{
    public $direcciones;
    public $mostrarFormulario = false;
    public $editandoId = null;
    public $modoCheckout = false;

    // Campos del formulario
    public $alias;
    public $destinatario;
    public $direccion;
    public $codigo_postal;
    public $provincia;
    public $ciudad;
    public $telefono;
    public $predeterminada = false;

    protected $rules = [
        'alias' => 'nullable|string|max:50',
        'destinatario' => 'required|string|max:100',
        'direccion' => 'required|string|max:255',
        'codigo_postal' => 'required|string|max:10',
        'provincia' => 'required|string|max:50',
        'ciudad' => 'required|string|max:50',
        'telefono' => 'required|string|max:20',
        'predeterminada' => 'boolean'
    ];

    public function mount()
    {
        $this->cargarDirecciones();
    }

    public function cargarDirecciones()
    {
        $this->direcciones = Auth::user()->direcciones()->get();
    }

    public function nuevaDireccion()
    {
        $this->resetFormulario();
        $this->mostrarFormulario = true;
        $this->editandoId = null;
    }

    public function editarDireccion($id)
    {
        $direccion = Direccion::findOrFail($id);

        $this->editandoId = $id;
        $this->alias = $direccion->alias;
        $this->destinatario = $direccion->destinatario;
        $this->direccion = $direccion->direccion;
        $this->codigo_postal = $direccion->codigo_postal;
        $this->provincia = $direccion->provincia;
        $this->ciudad = $direccion->ciudad;
        $this->telefono = $direccion->telefono;
        $this->predeterminada = $direccion->predeterminada;

        $this->mostrarFormulario = true;
    }

    public function guardarDireccion()
    {
        $this->validate();

        $data = [
            'cliente_id' => Auth::id(),
            'alias' => $this->alias,
            'destinatario' => $this->destinatario,
            'direccion' => $this->direccion,
            'codigo_postal' => $this->codigo_postal,
            'provincia' => $this->provincia,
            'ciudad' => $this->ciudad,
            'telefono' => $this->telefono,
            'predeterminada' => $this->predeterminada
        ];

        if ($this->editandoId) {
            $direccion = Direccion::find($this->editandoId);
            $direccion->update($data);
            session()->flash('message', 'Dirección actualizada correctamente.');
        } else {
            Direccion::create($data);
            session()->flash('message', 'Dirección creada correctamente.');
        }

        $this->resetFormulario();
        $this->cargarDirecciones();
        $this->mostrarFormulario = false;
    }

    public function eliminarDireccion($id)
    {
        $direccion = Direccion::findOrFail($id);

        // No permitir eliminar si es la única dirección
        if ($this->direcciones->count() <= 1) {
            session()->flash('error', 'No puedes eliminar tu única dirección.');
            return;
        }

        $direccion->delete();
        $this->cargarDirecciones();
        session()->flash('message', 'Dirección eliminada correctamente.');
    }

    public function cancelar()
    {
        $this->resetFormulario();
        $this->mostrarFormulario = false;
    }

    private function resetFormulario()
    {
        $this->reset([
            'alias', 'destinatario', 'direccion',
            'codigo_postal', 'provincia', 'ciudad',
            'telefono', 'predeterminada', 'editandoId'
        ]);
    }

    public function render()
    {
        return view('livewire.gestion-direcciones');
    }
}
