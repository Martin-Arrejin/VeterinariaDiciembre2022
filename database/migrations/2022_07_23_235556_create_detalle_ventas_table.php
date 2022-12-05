<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->integer('subtotal');
            $table->integer('descuento')->nullable();
            $table->timestamps();
            $table->foreignId('idVenta')->nullable()->constrained('ventas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idLote')->nullable()->constrained('lote_descripcions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ventas');
    }
}
