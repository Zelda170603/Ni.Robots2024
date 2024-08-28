<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\User;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalificacionBook>
 */
class CalificacionBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtener todos los usuarios y productos
        $users = User::all();
        $books = book::all();

        // Asegurarse de que haya usuarios y productos disponibles
        if ($users->isEmpty() || $books->isEmpty()) {
            throw new \Exception('No hay usuarios o productos disponibles para crear calificaciones.');
        }

        $userId = $users->random()->id;
        $bookId = $books->random()->id;

        return [
            'puntuacion' => $this->faker->numberBetween(1, 5),
            'comentario' => $this->faker->sentence,
            'id_book' => $bookId,
            'id_user' => $userId,
        ];
    }
}
