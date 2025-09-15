<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Autore;
use App\Models\Editoriale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class bookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
       return [
    'title' => $this->faker->word(), // Título del libro
    'file_url' => $this->faker->randomElement([
        'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
        'https://www.adobe.com/support/products/enterprise/knowledgecenter/media/c4611_sample_explain.pdf',
        'https://www.orimi.com/pdf-test.pdf',
    ]), // PDF real
    'autor_id' => Autore::inRandomOrder()->first()->id, // Autor aleatorio
    'editorial_id' => Editoriale::inRandomOrder()->first()->id, // Editorial aleatoria
    'portada' => 'https://firstbenefits.org/wp-content/uploads/2017/10/placeholder-1024x1024.png', // Imagen placeholder
    'categoria' => $this->faker->randomElement(['Literatura inclusiva', 'Educacion', 'Derechos y leyes', 'cuidado de la salud']),
    'grupo_usuarios' => $this->faker->randomElement(['Niños', 'Adolecentes', 'Adultos']),
    'descripcion' => $this->faker->paragraph(4), // Descripción del libro
    'fecha_publicacion' => $this->faker->date(), // Fecha de publicación
    'isbn' => $this->faker->unique()->isbn13(), // ISBN único
    'paginas' => $this->faker->numberBetween(100, 1000), // Número de páginas
];

    }
}
