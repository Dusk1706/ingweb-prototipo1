<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id('id_caja');
            $table->integer('id_sucursal');
            $table->string('denominacion');
            $table->integer('entregados')->default(0);
            $table->integer('existencia')->default(0);
            
            $table->primary('id_caja');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sucursales');
    }
};
