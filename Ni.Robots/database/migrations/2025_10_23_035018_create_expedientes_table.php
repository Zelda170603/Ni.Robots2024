<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_expedientes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->text('diagnostico')->nullable(); 
            $table->text('tratamiento')->nullable(); 
            $table->text('medicamentos')->nullable(); 
            $table->text('notas_adicionales')->nullable(); 
            $table->string('presion_arterial')->nullable(); 
            $table->decimal('temperatura', 5, 2)->nullable(); 
            $table->integer('frecuencia_cardiaca')->nullable(); 
            $table->integer('frecuencia_respiratoria')->nullable(); 
            $table->decimal('peso', 5, 2)->nullable(); 
            $table->decimal('altura', 5, 2)->nullable(); 
            $table->string('tipo_sangre')->nullable(); 
            $table->text('alergias')->nullable(); 
            $table->text('enfermedades_cronicas')->nullable(); 
            $table->text('cirugias_previas')->nullable(); 
            $table->text('medicamentos_actuales')->nullable(); 
            $table->text('historial_familiar')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expedientes');
    }
};