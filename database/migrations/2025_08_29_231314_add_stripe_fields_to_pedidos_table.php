<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/2025_08_29_xxxxxx_add_stripe_fields_to_pedidos_table.php
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Primero agregar la columna direccion_id
            $table->foreignId('direccion_id')->nullable()->after('cliente_id')
                ->constrained('direcciones')->onDelete('set null');

            // Luego agregar los campos de Stripe
            $table->string('stripe_session_id')->nullable()->after('estado');
            $table->string('stripe_payment_id')->nullable()->after('stripe_session_id');

            // Eliminar las columnas duplicadas (OPCIONAL - si las tienes)
            if (Schema::hasColumn('pedidos', 'destinatario')) {
                $table->dropColumn('destinatario');
            }
            if (Schema::hasColumn('pedidos', 'direccion_envio')) {
                $table->dropColumn('direccion_envio');
            }
            if (Schema::hasColumn('pedidos', 'codigo_postal')) {
                $table->dropColumn('codigo_postal');
            }
            if (Schema::hasColumn('pedidos', 'provincia')) {
                $table->dropColumn('provincia');
            }
            if (Schema::hasColumn('pedidos', 'ciudad')) {
                $table->dropColumn('ciudad');
            }
            if (Schema::hasColumn('pedidos', 'telefono_contacto')) {
                $table->dropColumn('telefono_contacto');
            }
        });
    }

    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Revertir los cambios
            $table->dropForeign(['direccion_id']);
            $table->dropColumn(['direccion_id', 'stripe_session_id', 'stripe_payment_id']);

            // Si eliminaste columnas, recrearlas
            $table->string('destinatario')->nullable();
            $table->string('direccion_envio')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('provincia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('telefono_contacto')->nullable();
        });
    }
};
