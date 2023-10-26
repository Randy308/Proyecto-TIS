<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementosBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elementos_banners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id');
            $table->string('text');
            $table->string('top');
            $table->string('left');
            $table->string('text_decoration');
            $table->string('font_style');
            $table->string('width');
            $table->string('height');
            $table->string('background');
            $table->string('color');
            $table->string('font_family');
            $table->string('font_size');
            $table->timestamps();
            $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elementos_banners');
    }
}
