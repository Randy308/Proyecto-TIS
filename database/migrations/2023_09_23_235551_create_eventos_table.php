<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nombre_evento'); // Cambiar el nombre del atributo a snake_case
            $table->text('descripcion_evento')->nullable();
            $table->enum('estado', ['Borrador','Activo', 'Finalizado', 'Cancelado']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->time('tiempo_inicio')->nullable();
            $table->time('tiempo_fin')->nullable();
            $table->string('direccion_banner');
            $table->double('latitud');
            $table->double('longitud');
            $table->string('background_color');
            $table->enum('tipo_evento', ['reclutamiento', 'competencia_individual', 'competencia_grupal', 'taller_individual', 'taller_grupal']);
            $table->enum('privacidad', ['libre', 'con-restriccion']);
            $table->double('costo')->nullable();
            $table->unsignedBigInteger('cantidad_minima')->nullable();
            $table->unsignedBigInteger('cantidad_maxima')->nullable();
            $table->string('institucion')->nullable();
            $table->timestamps();
            //tipo_de_evento
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
