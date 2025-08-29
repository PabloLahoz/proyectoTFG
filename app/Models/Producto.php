<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'material',
        'dimensiones',
        'condicion',
        'cantidad',
        'precio_ultima_compra',
        'precio_venta',
        'estado',
        'activo'
    ];

    public function detallesPedido() {
        return $this->hasMany(DetallePedido::class);
    }

    public function compras() {
        return $this->hasMany(Compra::class);
    }

    public function proveedores() {
        return $this->belongsToMany(Proveedor::class, 'compras');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

    public function imagen()
    {
        return $this->hasOne(Imagen::class);
    }

    protected static function booted()
    {
        static::saving(function ($producto) {
            // Asegurarse de que cantidad nunca sea negativa
            if ($producto->cantidad < 0) {
                $producto->cantidad = 0;
            }

            // Solo determinar el estado automático si el producto NO está desactivado manualmente
            if (is_null($producto->deleted_at)) {
                if ($producto->cantidad > 0 && $producto->precio_venta > 0) {
                    $producto->estado = 'Disponible';
                    $producto->activo = true;
                } else {
                    // Si no cumple las condiciones de disponible, está agotado
                    $producto->estado = 'Agotado';
                    $producto->activo = false;
                }
            } else {
                // Si está desactivado manualmente
                $producto->estado = 'Desactivado';
                $producto->activo = false;
            }
        });

        static::deleting(function ($producto) {
            // Solo eliminar imágenes si se está forzando el borrado
            if ($producto->isForceDeleting()) {
                foreach ($producto->imagenes as $imagen) {
                    if (\Storage::disk('public')->exists($imagen->ruta)) {
                        \Storage::disk('public')->delete($imagen->ruta);
                    }
                    $imagen->delete();
                }
            }
        });
    }
}
