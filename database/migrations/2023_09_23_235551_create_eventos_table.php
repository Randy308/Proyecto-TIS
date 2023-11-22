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
            $table->enum('categoria', ['Diseño','QA', 'Desarrollo', 'Ciencia de datos']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->time('tiempo_inicio')->nullable();
            $table->time('tiempo_fin')->nullable();
            $table->string('direccion_banner');
            $table->double('latitud');
            $table->double('longitud');
            $table->string('background_color');
            $table->timestamps();
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
