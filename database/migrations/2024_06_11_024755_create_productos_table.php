<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {


        Schema::dropIfExists('productos');
        Schema::dropIfExists('fotos_productos');



        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id', 10)->unique();
            $table->string('nombre_prod', 100);
            $table->string('descripcion', 400);
            $table->string('foto_prod', 100);
            $table->integer('precio');
            $table->string('color', 100);
            $table->string('tipo_afectacion', 100);
            $table->string('nivel_afectacion', 100);
            $table->string('grupo_usuarios', 100);
            $table->integer('existencias');
            $table->enum('tipo_producto', ['protesis', 'ortesis', 'ortopedicos']);
            $table->unsignedBigInteger('id_fabricante');
            $table->timestamps();
            $table->foreign('id_fabricante')->references('id')->on('fabricantes')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->index('nombre_prod');
        });

        Schema::create('fotos_productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 100);
            $table->unsignedBigInteger('id_producto');
            $table->timestamps();
            $table->foreign('id_producto')
                ->references('id')->on('productos')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('fotos_productos');
        DB::table('productos')->truncate();
        Schema::dropIfExists('productos');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
