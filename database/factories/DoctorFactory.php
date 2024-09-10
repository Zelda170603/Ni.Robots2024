<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use App\Models\Specialty;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition()
    {
        return [
            'cedula' => $this->faker->unique()->regexify('[0-9]{3}-[0-9]{6}-[0-9]{4}[A-Z]'),
            'biografia' => $this->faker->sentence(10),
            'edad' => $this->faker->numberBetween(25, 70),
            'genero' => $this->faker->randomElement(['masculino', 'femenino']),
            'area' => $this->faker->word(),
            'especialidad' => Specialty::inRandomOrder()->first()->name, // Randomly assign a specialty
            'telefono' => $this->faker->numerify('########'),
            'titulacion' => $this->faker->word(),
            'cod_minsa' => $this->faker->unique()->regexify('[A-Z0-9]{6}'),
        ];
    }
}