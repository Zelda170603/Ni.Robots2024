<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipo_productos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_productos')->insert([
            ['nombre_tipo' => 'Ortopédicos'],
            ['nombre_tipo' => 'Órtesis'],
            ['nombre_tipo' => 'Prótesis'],
        ]);
    }
}
