<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    /** @use HasFactory<\Database\Factories\ProveedorFactory> */
    use HasFactory;

    protected $fillable = ['nombre','telefono','email','cp','notas'];

    public function compras() {
        return $this->hasMany(Compra::class);
    }
}
