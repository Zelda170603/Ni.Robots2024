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
    public function up()
    {
        Schema::dropIfExists('productos');
        Schema::dropIfExists('tipo_productos');

        Schema::create('tipo_productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_tipo', 100);
        });
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id',10)->unique();
            $table->string('nombre_prod', 100);
            $table->string('descripcion', 400);
            $table->string('foto_prod', 100);
            $table->integer('precio');
            $table->string('color', 100);
            $table->string('nivel_afectacion', 100);
            $table->string('grupo_usuarios', 100);
            $table->integer('existencias');
            $table->unsignedBigInteger('id_tipo_producto');
            $table->unsignedBigInteger('id_fabricante');
            $table->timestamps();
            $table->foreign('id_tipo_producto')->references('id')->on('tipo_productos')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_fabricante')->references('id')->on('fabricantes')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::table('productos')->truncate();
        Schema::dropIfExists('productos');
        Schema::dropIfExists('tipo_productos');
    }
};
