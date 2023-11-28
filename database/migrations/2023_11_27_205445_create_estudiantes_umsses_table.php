<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesUmssesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes_umsses', function (Blueprint $table) {
            $table->id();
            $table->string('nombrecompleto', 100);
            $table->string('institucion');
            $table->string('carrera');
            $table->string('correo')->unique();
            $table->date('fechaNacimiento');
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
        Schema::dropIfExists('estudiantes_umsses');
    }
}
