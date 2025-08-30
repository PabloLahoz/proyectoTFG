<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pedido extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoFactory> */
    use HasFactory;

    protected $fillable = ['cliente_id','direccion_id','estado','metodo_pago','fecha_pedido','total_pedido','stripe_session_id','stripe_payment_id'];

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
    public function cliente() {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}
