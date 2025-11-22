<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Autor;
use App\Models\Editorial;

class bookseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
      public function run(): void
    { 
        // Crear 20 libros usando el factory
        Book::factory()->count(20)->create(); 
        // Mensaje de confirmación en consola
        $this->command->info('¡20 libros creados con éxito!');
    }
}
