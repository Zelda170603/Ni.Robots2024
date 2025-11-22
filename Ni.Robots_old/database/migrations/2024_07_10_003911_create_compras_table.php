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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('compra_id',10)->unique();
            $table->unsignedBigInteger('carrito_id')->nullable();
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pendiente');
            $table->string('paypal_order_id')->nullable();
            $table->foreign('carrito_id')->references('id')->on('carritos')->nullOnDelete(); // Null on delete
            $table->timestamps();
        });
        
        Schema::create('compra_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('compras')->onDelete('cascade');
            $table->integer('producto_id');
            $table->integer('fabricante_id');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        DB::table('compra_productos')->truncate();
        Schema::dropIfExists('compra_productos');
        DB::table('compras')->truncate();
        Schema::dropIfExists('compras');
    }
};
