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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
            $table->string('alias')->nullable()->comment('Casa, Trabajo, etc.');
            $table->string('destinatario');
            $table->string('direccion');
            $table->string('codigo_postal');
            $table->string('provincia');
            $table->string('ciudad');
            $table->string('telefono');
            $table->boolean('predeterminada')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
