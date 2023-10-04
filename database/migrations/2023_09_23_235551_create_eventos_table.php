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
            $table->id('idEvento');
            $table->string('nombre_evento'); // Cambiar el nombre del atributo a snake_case
            $table->text('descripcion_evento');
            $table->enum('estado', ['borrador','activo', 'finalizado', 'cancelado']);
            $table->string('categoria');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('direccion_banner');
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
        Schema::dropIfExists('eventos');
    }
}
