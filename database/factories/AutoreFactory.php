<?php

namespace Database\Factories;

use App\Models\Autore;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Autor>
 */
class AutoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Autore::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'fecha_nacimiento' => $this->faker->date(),
            'fecha_fallecimiento' => $this->faker->optional()->date(), // Puede ser nulo
            'nacionalidad' => $this->faker->country(),
            'biografia' => $this->faker->paragraphs(3, true),
        ];
    }
}

