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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 100);
            $table->string('biografia', 500);
            $table->integer('edad');
            $table->integer('peso');
            $table->integer('altura');
            $table->string('genero',10);
            $table->string('condicion', 500);
            $table->string('tipo_afectacion', 100);
            $table->string('nivel_afectacion', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
