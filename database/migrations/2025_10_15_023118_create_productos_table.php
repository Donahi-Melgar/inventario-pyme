<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('sku', 50)->unique();
            $table->integer('cantidad')->default(0);
            $table->integer('stock_minimo')->default(5);
            $table->decimal('precio', 10, 2)->default(0);
            $table->string('proveedor', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
