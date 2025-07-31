<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Mostrar el carrito
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    // Añadir producto al carrito
    public function add(Request $request, $productoId)
    {
        $producto = Producto::findOrFail($productoId);
        $cantidad = $request->input('cantidad', 1);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad'] += $cantidad;
        } else {
            $carrito[$productoId] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio_venta,
                'imagen' => $producto->imagen ?? null,
                'cantidad' => $cantidad,
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = $request->cantidad;
            session()->put('carrito', $carrito);
            return redirect()->back()->with('success', 'Cantidad actualizada.');
        }

        return redirect()->back()->with('error', 'Producto no encontrado en el carrito.');
    }

    // Eliminar producto del carrito
    public function eliminar($productoId)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            unset($carrito[$productoId]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    // Vaciar todo el carrito
    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->back()->with('success', 'Carrito vaciado.');
    }

    public function realizarPedido(Request $request)
    {
        $request->validate([
            'direccion_envio' => 'required|string|max:255',
            'metodo_pago' => 'required|in:tarjeta,transferencia,paypal',
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
}
