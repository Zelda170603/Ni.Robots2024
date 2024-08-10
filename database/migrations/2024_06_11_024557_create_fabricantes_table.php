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
        // Drop the table if it already exists
        Schema::dropIfExists('fabricantes');
        
        // Create the table
        Schema::create('fabricantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id')/*added later*/->unique();
            $table->string('nombre', 100);
            $table->string('foto_fabr', 100);
            $table->string('ubicacion', 100);
            $table->string('descripcion',500);
            $table->string('direccion', 100);
            $table->string('google_map_direction',300);
            $table->bigInteger('telefono');
            $table->timestamps();
        });
    }

/**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('fabricantes');
    }
};
