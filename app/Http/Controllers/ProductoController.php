<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Imagen;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::withTrashed()->with('imagen')->orderByRaw('deleted_at IS NULL DESC')->get();
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
        try {
            $datos = $request->validated();

            $datos['cantidad'] = 0;
            $datos['activo'] = false;

            $producto = Producto::create($datos);
            $id_producto = $producto->id;
            if($id_producto > 0) {
                if($this->subir_imagen($request, $id_producto)){
                    return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente');
                } else {
                    return redirect()->route('admin.productos.index')->with('error', 'No se subió la imagen');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->route('admin.productos.index')->with('error', 'Fallo al crear producto!' . $th->getMessage());
        }
        return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente');
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
        // Solo impedir borrar si hay stock > 0
        if ($producto->cantidad > 0) {
            return redirect()->back()->with('error', 'No se puede eliminar un producto con stock disponible.');
        }

        $producto->estado = 'Desactivado';
        $producto->activo = false;
        $producto->save();

        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function estado($id, $estado) {
        $item = Producto::find($id);
        $item->activo = $estado;
        return $item->save();
    }

    public function subir_imagen($request, $id_producto) {
        if ($request->hasFile('imagen')) {
            // Guarda en el bucket S3 en la carpeta productos/
            $rutaImagen = $request->file('imagen')->store('productos', 's3');

            $item = new Imagen();
            $item->producto_id = $id_producto;
            $item->nombre = basename($rutaImagen);
            $item->ruta = $rutaImagen; // aquí guardamos la ruta tal cual nos da S3
            return $item->save();
        }
        return false;
    }

    public function catalogo()
    {
        $productos = Producto::with('imagen')->where('activo', true)->get();
        return view('catalogo.index', compact('productos'));
    }

    public function mostrar(Producto $producto)
    {
        return view('catalogo.show', compact('producto'));
    }

    public function restore($id)
    {
        $producto = Producto::withTrashed()->findOrFail($id);

        if ($producto->trashed()) {
            $producto->restore();

            $producto->refresh();
            $producto->save();
            return redirect()->route('admin.productos.index')
                ->with('success', 'Producto restaurado correctamente.');
        }

        return redirect()->route('admin.productos.index')
            ->with('info', 'El producto ya estaba activo.');
    }
}
