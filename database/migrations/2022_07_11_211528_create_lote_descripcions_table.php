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
        Schema::create('lote_descripcions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('unidad')->nullable();
            $table->float('precioCompra')->nullable();
            $table->date('vencimiento')->nullable();
            $table->boolean('estado')->nullable();
            $table->foreignId('articulo_id')->constrained('articulos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lote_descripcions');
    }
};
