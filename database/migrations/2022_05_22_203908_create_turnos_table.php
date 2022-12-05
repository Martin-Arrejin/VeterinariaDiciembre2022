<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');//titulo del evento 
            $table->dateTime('start');//fecha de inicio
            $table->dateTime('end');//fecha final 
            $table->string('tipo')->nullable();//veterinaria o peluquero 
            $table->integer('estado')->nullable();//disponible 0, no disponbile 1 (3 estado eliminado)
            $table->string('asunto')->nullable();//informacion detallada del turno
            $table->timestamps();
            $table->foreignId('persona_id')->nullable()->constrained('personas')->onUpdate('cascade')->onDelete('cascade');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnos');
    }
}
