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
        'estado',
        'cantidad',
        'precio_ultima_compra',
        'precio_venta',
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

    public function getEstadoAttribute()
    {
        if ($this->trashed()) {
            return 'Eliminado';
        }

        if ($this->cantidad <= 0) {
            return 'Agotado';
        }

        return 'Disponible';
    }

    protected static function booted()
    {
        static::saving(function ($producto) {
            // nunca negativo
            if ($producto->cantidad < 0) {
                $producto->cantidad = 0;
            }

            // activar si hay cantidad y precio de venta definido y > 0
            if ($producto->cantidad > 0 && $producto->precio_venta !== null && $producto->precio_venta > 0) {
                $producto->activo = true;
            } else {
                $producto->activo = false;
            }
        });

        static::deleting(function ($producto) {
            foreach ($producto->imagenes as $imagen) {
                if (\Storage::disk('public')->exists($imagen->ruta)) {
                    \Storage::disk('public')->delete($imagen->ruta);
                }
                $imagen->delete();
            }
        });
    }
}
