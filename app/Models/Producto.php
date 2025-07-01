<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'material',
        'dimensiones',
        'estado',
        'cantidad',
        'precio_ultima_compra',
        'precio_venta',
        'activo',
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

    protected static function booted()
    {
        static::deleting(function ($producto) {
            foreach ($producto->imagenes as $imagen) {
                // Eliminar archivo físico
                if (\Storage::disk('public')->exists($imagen->ruta)) {
                    \Storage::disk('public')->delete($imagen->ruta);
                }

                // Eliminar el registro de la imagen
                $imagen->delete();
            }
        });
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

    public function imagen()
    {
        return $this->hasOne(Imagen::class);
    }

}
