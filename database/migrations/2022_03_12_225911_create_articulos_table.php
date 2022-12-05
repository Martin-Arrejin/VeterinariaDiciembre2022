<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('codigo')->unsigned()->nullable();
            $table->string('descripcion')->nullable();
            $table->string('marca')->nullable();
            $table->float('precioVenta')->nullable();
            $table->float('precioEspecial')->nullable();
            $table->integer('cantidadTotal')->nullable();
            $table->integer('minimoStock')->nullable();
            $table->float('iva')->nullable();
            $table->integer('alerta')->nullable();
            $table->boolean('estado')->nullable();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onUpdate('cascade')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
};
