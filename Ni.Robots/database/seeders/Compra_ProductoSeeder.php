<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra_producto;

class Compra_productoSeeder extends Seeder
{
    public function run(): void
    {
        Compra_producto::factory()->count(20)->create();
    }
}
