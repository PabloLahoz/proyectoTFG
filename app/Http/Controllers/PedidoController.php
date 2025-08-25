<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('cliente')
        ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pedidos.index', compact('pedidos'));
    }

    /**
     * Muestra los detalles de un pedido.
     */
    public function show(Pedido $pedido)
    {
        $pedido->load('cliente', 'detalles.producto');

        return view('admin.pedidos.show', compact('pedido'));
    }

    /**
     * Elimina un pedido.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('admin.pedidos.index')->with('success', 'Pedido eliminado correctamente.');
    }

    public function checkout()
    {
        return view('carrito.checkout');
    }
}
