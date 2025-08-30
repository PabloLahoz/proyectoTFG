<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
            $table->enum('estado', ['procesando', 'enviado', 'entregado', 'cancelado', 'pagado'])->default('pagado');
            $table->enum('metodo_pago', ['tarjeta', 'transferencia', 'paypal'])->default('tarjeta');
            $table->float('total_pedido');
            $table->timestamp('fecha_pedido')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
