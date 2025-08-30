<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        'cliente_id',
        'alias',
        'destinatario',
        'direccion',
        'codigo_postal',
        'provincia',
        'ciudad',
        'telefono',
        'predeterminada'
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'direccion_id');
    }

    // Scope para direcciones del usuario autenticado
    public function scopeDelUsuario($query)
    {
        return $query->where('cliente_id', auth()->id());
    }

    // Marcar solo una dirección como predeterminada
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($direccion) {
            if ($direccion->predeterminada) {
                self::where('cliente_id', $direccion->cliente_id)
                    ->where('id', '!=', $direccion->id)
                    ->update(['predeterminada' => false]);
            }
        });
    }
}
