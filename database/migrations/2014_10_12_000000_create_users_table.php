<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->enum('estado', ['Habilitado','Deshabilitado']);
            $table->string('pais')->nullable();
            $table->string('historial_academico')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->date('fecha_nac')->nullable();
            $table->unsignedBigInteger('institucion_id');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('institucion_id')->references('id')->on('institucions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
