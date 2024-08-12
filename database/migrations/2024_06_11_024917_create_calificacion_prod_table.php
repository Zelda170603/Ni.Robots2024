<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        //drop table if exists
        Schema::dropIfExists('calificacion_prod');
        //create table
        Schema::create('calificacion_prod', function (Blueprint $table) {
            $table->bigIncrements('id_cal');
            $table->unsignedBigInteger('id_user');
            $table->integer('puntuacion');
            $table->string('comentario', 300);
            $table->unsignedBigInteger('id_prod');
            $table->foreign('id_prod')->references('id')->on('productos')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('calificacion_prod');
    }
};
