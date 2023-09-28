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
        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            $table->string('Titulo');
            $table->binary('DireccionImg')->nullable();
            $table->text('Descripcion');
            $table->enum('Estado', ['Activo', 'Finalizado', 'Cancelado']);
            $table->dateTime('FechaInicio');
            $table->dateTime('FechaFin');
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
        Schema::dropIfExists('evento');
    }
}
