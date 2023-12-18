<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_eventos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id');
            $table->integer('secuencia');
            $table->string('nombre_fase');
            $table->string('descripcion_fase');
            $table->dateTimeTz('fechaInicio');
            $table->dateTimeTz('fechaFin');
            $table->enum('tipo', ['Inscripcion','General','Calificacion', 'Finalizacion']);
            $table->boolean('actual');
            $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('fase_eventos');
    }
}
