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
        Schema::dropIfExists('tipos_afectaciones'); 
        Schema::dropIfExists('categorias_afectaciones'); 
         // Crear tabla para las categorías
        Schema::create('categorias_afectaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Crear tabla para los tipos de afectaciones
        Schema::create('tipos_afectaciones', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->text('descripcion');
            $table->foreignId('categoria_id')->constrained('categorias_afectaciones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_afectaciones'); 
        Schema::dropIfExists('categorias_afectaciones');
    }
};
