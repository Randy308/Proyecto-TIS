<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenEventoTable extends Migration
{
    public function up()
    {
        Schema::create('imagenEvento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEvento');
            $table->string('direccionImagen');
            $table->float('coordX', 0, 0);
            $table->float('coordY', 8, 6);
            $table->timestamps();

            // Definir la clave foránea hacia la tabla "eventos"
            $table->foreign('idEvento')->references('idEvento')->on('eventos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagenEvento');
    }
}
