<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('asistencia_eventos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEvento');
            $table->unsignedBigInteger('idUsuario');
            $table->string('rol');
            $table->date('fechaInscripcion');
            $table->string('estado');
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('idEvento')->references('idEvento')->on('eventos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('asistencia_eventos');
    }
}
