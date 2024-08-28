<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Autore;
use App\Models\Editoriale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\book>
 */
class bookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Book::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(), // Título del libro
            'file_url' => $this->faker->randomElement([
            'https://s3.amazonaws.com/your-bucket-name/files/' . $this->faker->uuid . '.pdf',
            'https://www.dropbox.com/s/' . $this->faker->regexify('[A-Za-z0-9]{15}') . '/' . $this->faker->slug . '.pdf?dl=0',
            'https://storage.googleapis.com/your-bucket-name/' . $this->faker->uuid . '.pdf',
        ]),
            'autor_id' => Autore::inRandomOrder()->first()->id, // Selecciona un autor aleatorio
            'editorial_id' => Editoriale::inRandomOrder()->first()->id, // Selecciona una editorial aleatoria
            'portada' => $this->faker->imageUrl(400, 600, 'books', true, 'Faker'), // Imagen de la portada
            'categoria' => $this->faker->randomElement(['Literatura inclusiva', 'Educacion', 'Derechos y leyes', 'cuidado de la salud']),
            'grupo_usuarios' => $this->faker->randomElement(['Niños', 'Adolecentes', 'Adultos']),
            'descripcion' => $this->faker->paragraph(4), // Descripción del libro
            'fecha_publicacion' => $this->faker->date(), // Fecha de publicación
            'isbn' => $this->faker->unique()->isbn13(), // ISBN único
            'paginas' => $this->faker->numberBetween(100, 1000), // Número de páginas
        ];
    }
}
