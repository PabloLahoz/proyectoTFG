<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    /** @use HasFactory<\Database\Factories\CompraFactory> */
    use HasFactory;

    protected $fillable = ['producto_id','nombre_producto', 'proveedor_id', 'nombre_proveedor', 'cantidad', 'precio_compra'];

    public function producto() {
        return $this->belongsTo(Producto::class);
    }

    public function proveedor() {
        return $this->belongsTo(Proveedor::class);
    }
}
