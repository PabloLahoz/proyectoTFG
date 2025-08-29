<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Compra::with('producto', 'proveedor')->latest()->get();
        return view('admin.compras.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        return view('admin.compras.create', compact('productos', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {
        $datos = $request->validated(); // ✔️ Aquí validas y usas los datos directamente

        $producto = Producto::findOrFail($datos['producto_id']);
        $proveedor = Proveedor::findOrFail($datos['proveedor_id']);

        $compra = new Compra([
            ...$datos, // Esto incluye cantidad, precio_compra, etc.
            'nombre_producto' => $producto->nombre,
            'nombre_proveedor' => $proveedor->nombre,
        ]);

        if ($compra->save()) {
            $producto->cantidad += $datos['cantidad'];
            $producto->precio_ultima_compra = $datos['precio_compra'];
            $producto->save();
        }

        return redirect()->route('admin.productos.index')->with('success', 'Compra registrada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompraRequest $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        // Buscar el producto relacionado
        $producto = Producto::find($compra->producto_id);

        if ($producto) {
            // Restar la cantidad de la compra
            $producto->cantidad -= $compra->cantidad;

            // Asegurarse de que la cantidad no sea negativa
            if ($producto->cantidad < 0) {
                $producto->cantidad = 0;
            }

            if ($producto->cantidad === 0) {
                $producto->activo = false;
            }

            $producto->save();
        }

        // Eliminar la compra
        $compra->delete();

        return redirect()->route('admin.compras.index')->with('status', 'Compra eliminada y cantidad ajustada');
    }
}
