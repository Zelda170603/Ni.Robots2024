<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Producto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CalificacionProdFactory extends Factory
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
        $products = Producto::all();

        // Asegurarse de que haya usuarios y productos disponibles
        if ($users->isEmpty() || $products->isEmpty()) {
            throw new \Exception('No hay usuarios o productos disponibles para crear calificaciones.');
        }

        $userId = $users->random()->id;
        $productId = $products->random()->id;

        return [
            'puntuacion' => $this->faker->numberBetween(1, 5),
            'comentario' => $this->faker->sentence,
            'id_prod' => $productId,
            'id_user' => $userId,
        ];
    }
}
