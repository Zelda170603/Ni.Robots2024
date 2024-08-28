<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calificacion_book', function (Blueprint $table) {
            $table->bigIncrements('id_cal');
            $table->unsignedBigInteger('id_user');
            $table->integer('puntuacion');
            $table->string('comentario', 300);
            $table->unsignedBigInteger('id_book');
            $table->foreign('id_book')->references('id')->on('books')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacion_book');
    }
};
