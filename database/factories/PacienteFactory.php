<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Paciente::class;


    public function definition()
    {
        $categoria = DB::table('categorias_afectaciones')
            ->select('id', 'nombre')
            ->inRandomOrder()
            ->first();

        // Seleccionar un tipo de afectación basado en la categoría seleccionada
        $tipoAfectacion = $categoria ? DB::table('tipos_afectaciones')
            ->where('categoria_id', $categoria->id)
            ->inRandomOrder()
            ->first() : null;

        return [
            'cedula' => $this->faker->unique()->regexify('[0-9]{3}-[0-9]{6}-[0-9]{4}[A-Z]'),
            'biografia' => $this->faker->sentence(10),
            'edad' => $this->faker->numberBetween(18, 90),
            'peso' => $this->faker->numberBetween(50, 120),
            'altura' => $this->faker->randomFloat(2, 1.50, 2.00),
            'genero' => $this->faker->randomElement(['masculino', 'femenino']),
            'condicion' => 'Hipertensión',
            'tipo_afectacion' => $categoria->nombre,
            'nivel_afectacion' => $tipoAfectacion->tipo,
        ];
    }
}
