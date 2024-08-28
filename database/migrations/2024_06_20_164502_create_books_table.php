<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_url');
            $table->unsignedBigInteger('autor_id'); // ID del autor
            $table->unsignedBigInteger('editorial_id'); // ID de la editorial
            $table->string('portada'); // Imagen de la portada
            $table->enum('categoria',['Literatura inclusiva','Educacion','Derechos y leyes','cuidado de la salud']);
            $table->enum('grupo_usuarios',['Niños','Adolecentes','Adultos']);
            $table->text('descripcion'); // Descripción del libro
            $table->date('fecha_publicacion'); // Fecha de publicación
            $table->string('isbn')->unique(); // ISBN del libro
            $table->integer('paginas'); // Número de páginas
            $table->timestamps(); // Timestamps para created_at y updated_at
            $table->foreign('autor_id')->references('id')->on('autores')->onDelete('cascade');
            $table->foreign('editorial_id')->references('id')->on('editoriales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}

