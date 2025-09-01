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
        $carrito = session('carrito', []);

        foreach ($carrito as $id => $item) {
            $producto = Producto::find($id);
            if ($producto) {
                $carrito[$id]['stock'] = $producto->cantidad; // 'cantidad' es el stock real en DB
            } else {
                $carrito[$id]['stock'] = 0; // Si el producto no existe
            }
        }

        return view('carrito.index', compact('carrito'));
    }

    // Añadir producto al carrito
    public function add(Request $request, $productoId)
    {
        $producto = Producto::findOrFail($productoId);
        $cantidad = $request->input('cantidad', 1);

        $carrito = session()->get('carrito', []);

        $cantidadTotal = $cantidad;
        if (isset($carrito[$productoId])) {
            $cantidadTotal += $carrito[$productoId]['cantidad'];
        }

        if ($cantidadTotal > $producto->cantidad) {
            return redirect()->back()->with('error', "No puedes añadir más de {$producto->cantidad} unidades de {$producto->nombre}.");
        }

        $carrito[$productoId] = [
            'id' => $producto->id,
            'nombre' => $producto->nombre,
            'precio' => $producto->precio_venta,
            'imagen' => $producto->imagen ?? null,
            'cantidad' => $cantidad,
            'stock' => $producto->cantidad,
        ];

        $carrito[$productoId]['stock'] = $producto->cantidad;

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
            $producto = Producto::findOrFail($id);
            $cantidadSolicitada = $request->cantidad;

            if ($cantidadSolicitada > $producto->cantidad) {
                return redirect()->back()->with('error', "No puedes pedir más de {$producto->cantidad} unidades de {$producto->nombre}.");
            }

            $carrito[$id]['cantidad'] = $cantidadSolicitada;
            $carrito[$id]['stock'] = $producto->cantidad; // <--- actualizamos stock siempre

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
}
