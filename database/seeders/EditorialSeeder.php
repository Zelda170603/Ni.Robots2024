<?php

namespace Database\Seeders;

use App\Models\Editoriale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Editoriale::create([
            'nombre' => 'Penguin Random House',
            'direccion' => '1745 Broadway, New York, NY 10019, USA',
            'telefono' => '+1 212-782-9000',
            'correo_electronico' => 'info@penguinrandomhouse.com',
            'sitio_web' => 'https://www.penguinrandomhouse.com',
        ]);
    }
}
