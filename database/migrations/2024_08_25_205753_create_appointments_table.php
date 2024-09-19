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
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('scheduled_date');
            $table->time('scheduled_time');
            $table->string('type');
            $table->string('description');
            $table->string('status')->default('Reservada');
            //doctor
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctor')->onDelete('cascade')->onUpdate('cascade');
            //paciente
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('pacientes')->onDelete('cascade')->onUpdate('cascade');

            //Spelcialty
            $table->string('specialty', 100);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('appointments');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
