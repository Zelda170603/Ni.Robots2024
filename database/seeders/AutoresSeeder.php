<?php

namespace Database\Seeders;

use App\Models\Autore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Autore::create([
            'nombre' => 'Gabriel',
            'apellido' => 'García Márquez',
            'fecha_nacimiento' => '1927-03-06',
            'fecha_fallecimiento' => '2014-04-17',
            'nacionalidad' => 'Colombiana',
            'biografia' => 'Gabriel García Márquez fue un novelista, cuentista, guionista y periodista colombiano, conocido principalmente por su obra "Cien años de soledad".',
        ]);
    }
}
