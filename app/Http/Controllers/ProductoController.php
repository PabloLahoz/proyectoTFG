<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use App\Models\Proveedor;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    // Mostrar el formulario para crear un nuevo producto
    public function create()
    {
        return view('admin.productos.create');
    }

    // Almacenar un nuevo producto
    public function store(StoreProductoRequest $request)
    {
        $datos = $request->validated();

        $datos['cantidad'] = 0;
        $datos['activo'] = false;

        Producto::create($datos);

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar los detalles de un producto
    public function show(Producto $producto)
    {
        return view('admin.productos.show', compact('producto'));
    }

    // Mostrar el formulario para editar un producto
    public function edit(Producto $producto)
    {
        $proveedores = Proveedor::all();
        return view('admin.productos.edit', compact('producto', 'proveedores'));
    }

    // Actualizar un producto existente
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto
    public function destroy(Producto $producto)
    {
        if ($producto->compras()->exists() && $producto->activo) {
            return redirect()->back()->with('error', 'No se puede eliminar un producto activo con compras registradas.');
        }

        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function estado($id, $estado) {
        $item = Producto::find($id);
        $item->activo = $estado;
        return $item->save();
    }
}
