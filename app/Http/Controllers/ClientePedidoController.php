<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientePedidoController extends Controller
{
    // Muestra todos los pedidos del cliente autenticado
    public function index()
    {
        $pedidos = Pedido::where('cliente_id', Auth::id())
            ->orderByDesc('fecha_pedido')
            ->get();

        return view('cliente.pedidos.index', compact('pedidos'));
    }

    // Muestra un pedido específico si pertenece al cliente autenticado
    public function show(Pedido $pedido)
    {
        // Asegurarse de que el pedido le pertenece al usuario
        if ($pedido->cliente_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este pedido.');
        }

        // Cargar los detalles con el producto asociado
        $pedido->load('detalles.producto');

        return view('cliente.pedidos.show', compact('pedido'));
    }

    public function cancelar(Pedido $pedido)
    {
        // Verificamos que el pedido pertenece al usuario autenticado
        if ($pedido->cliente_id !== auth()->id()) {
            abort(403, 'No puedes cancelar este pedido.');
        }

        // Solo se puede cancelar si está en estado pendiente
        if ($pedido->estado !== 'pendiente') {
            return back()->with('error', 'Este pedido ya no se puede cancelar.');
        }

        // Devolvemos el stock de cada producto en el pedido
        foreach ($pedido->detalles as $detalle) {
            $producto = $detalle->producto;
            $producto->stock += $detalle->cantidad;
            $producto->save();
        }

        // Marcamos el pedido como cancelado
        $pedido->estado = 'cancelado';
        $pedido->save();

        return redirect()->route('cliente.pedidos.index')
            ->with('success', 'El pedido ha sido cancelado y el stock se ha restaurado.');
    }
}
