<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calificacion_id');
            $table->unsignedBigInteger('grupo_id');
            $table->integer('puntaje');
            $table->foreign('calificacion_id')->references('id')->on('calificacions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('calificacion_grupos');
    }
}
