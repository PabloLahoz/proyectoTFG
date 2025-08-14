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
        $pedidos = Pedido::with('user') // Asegúrate de tener la relación definida en el modelo
        ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pedidos.index', compact('pedidos'));
    }

    /**
     * Muestra los detalles de un pedido.
     */
    public function show(Pedido $pedido)
    {
        $pedido->load('user', 'detalles.producto'); // Asegúrate de tener estas relaciones

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

    public function realizarPedido(Request $request)
    {
        $request->validate([
            'direccion_envio' => 'required|string|max:255',
            'metodo_pago' => 'required|in:tarjeta,transferencia',
        ]);

        $carrito = session('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('catalogo')->with('error', 'Tu carrito está vacío.');
        }

        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['producto']->precio_venta * $item['cantidad'];
        }

        $pedido = Pedido::create([
            'cliente_id' => Auth::id(),
            'direccion_envio' => $request->direccion_envio,
            'estado' => 'pendiente',
            'metodo_pago' => $request->metodo_pago,
            'total_pedido' => $total,
        ]);

        foreach ($carrito as $item) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $item['producto']->id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['producto']->precio_venta,
            ]);

            // Descontar stock
            $item['producto']->decrement('cantidad', $item['cantidad']);
        }

        session()->forget('carrito');

        return redirect()->route('cliente.pedidos.index')
            ->with('success', 'Pedido realizado correctamente. Redirigiendo a su banco...');
    }

    public function checkout()
    {
        return view('carrito.checkout');
    }
}
