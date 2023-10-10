<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenEventoTable extends Migration
{
    public function up()
    {
        Schema::create('imagenEventos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id');
            $table->string('direccionImagen');
            $table->float('coordX', 0, 0);
            $table->float('coordY', 8, 6);
            $table->timestamps();

            // Definir la clave foránea hacia la tabla "eventos"
            $table->foreign('evento_id')->references('id')->on('eventos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagenEventos');
    }
}
