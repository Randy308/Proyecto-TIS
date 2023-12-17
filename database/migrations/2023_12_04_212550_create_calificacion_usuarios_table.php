<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calificacion_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('puntaje');
            $table->integer('evento_id');          
            $table->foreign('calificacion_id')->references('id')->on('calificacions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // Otros campos relacionados con el puntaje del usuario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificacion_usuarios');
    }
}
