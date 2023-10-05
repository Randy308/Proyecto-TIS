<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEvento');
            $table->unsignedBigInteger('idUsuario');
            $table->string('rol');
            $table->date('fechaInscripcion');
            $table->string('estado');
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('idEvento')->references('idEvento')->on('eventos');
            $table->foreign('idUsuario')->references('idUsuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participante');
    }
}
