<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordenadaEventoTable extends Migration
{
    public function up()
    {
        Schema::create('CoordenadaEvento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEvento');
            $table->float('nombreEx', 8, 6);
            $table->float('nombreEy', 8, 6);
            $table->float('descripcionEx', 8, 6);
            $table->float('descripcionEy', 8, 6);
            $table->float('fechaIX', 8, 6);
            $table->float('fechaIY', 8, 6);
            $table->float('fechaFX', 8, 6);
            $table->float('fechaFY', 8, 6);
            $table->boolean('mostrarOrganizaciones')->default(false);
            $table->boolean('mostrarPatrocinadores')->default(false);
            $table->timestamps();

            // Definir la clave foránea hacia la tabla "eventos"
            $table->foreign('idEvento')->references('idEvento')->on('eventos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('CoordenadaEvento');
    }
}
