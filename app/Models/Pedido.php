<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pedido extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoFactory> */
    use HasFactory;

    protected $fillable = ['cliente_id','direccion_envio','estado','metodo_pago','fecha_pedido','destinatario','codigo_postal','provincia','ciudad','telefono_contacto','total_pedido'];

    protected $casts = [
        'fecha_pedido' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($pedido) {
            if (!$pedido->fecha_pedido) {
                $pedido->fecha_pedido = Carbon::now();
            }
        });
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}
