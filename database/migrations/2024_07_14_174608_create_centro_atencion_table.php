<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('centro_atencion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('correo');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('departamento');
            $table->string('google_map_direction');
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['Minsa', 'Psicologia',  'Terapia', 'Otros'])->default('Minsa');
            $table->timestamps();
        });
        Schema::create('fotos_centro_atencion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('centro_atencion_id');
            $table->string('foto');
            $table->boolean('principal')->default(false);
            $table->timestamps();
            $table->foreign('centro_atencion_id')->references('id')->on('centro_atencion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        DB::table('fotos_centro_atencion')->truncate();
        Schema::dropIfExists('fotos_centro_atencion');
        DB::table('centro_atencion')->truncate();
        Schema::dropIfExists('centro_atencion');
    }
};
