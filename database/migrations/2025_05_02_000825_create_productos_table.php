<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('material');
            $table->string('dimensiones');
            $table->enum("condicion", ['nuevo', 'seminuevo'])->default('seminuevo');
            $table->integer('cantidad')->default(0);
            $table->decimal('precio_ultima_compra',10,2)->default(0);
            $table->decimal('precio_venta',10,2)->nullable();
            $table->string('estado')->default('Desactivado');
            $table->boolean('activo')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
