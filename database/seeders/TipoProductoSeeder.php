<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoProducto;

class TipoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tiposProductos = [
            ['nombre_tipo' => 'Ortopédicos'],
            ['nombre_tipo' => 'Órtesis'],
            ['nombre_tipo' => 'Prótesis'],
        ];

        foreach ($tiposProductos as $tipoProducto) {
            TipoProducto::create($tipoProducto);
        }
    }
}
