<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('movimientos', function (Blueprint $table) {
            // Asegurarse de que las columnas existan antes de aplicar la relación
            if (!Schema::hasColumn('movimientos', 'producto_id')) {
                $table->unsignedBigInteger('producto_id')->nullable()->after('id');
            }

            if (!Schema::hasColumn('movimientos', 'usuario_id')) {
                $table->unsignedBigInteger('usuario_id')->nullable()->after('producto_id');
            }

            // Agregar claves foráneas
            $table->foreign('producto_id')
                  ->references('id')->on('productos')
                  ->onDelete('cascade'); // si se elimina producto, se eliminan sus movimientos

            $table->foreign('usuario_id')
                  ->references('id')->on('users')
                  ->onDelete('set null'); // si se elimina usuario, deja nulo
        });
    }

    public function down()
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropForeign(['producto_id']);
            $table->dropForeign(['usuario_id']);
        });
    }
};
