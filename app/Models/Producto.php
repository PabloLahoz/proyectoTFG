<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = [
        'proveedor_id',
        'nombre',
        'material',
        'dimensiones',
        'estado',
        'cantidad',
        'precio_compra',
        'precio_venta',
        'activo',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
