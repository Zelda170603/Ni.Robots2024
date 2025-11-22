<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Departamento;
use App\Models\Municipio;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        $departamento = Departamento::first();
        $municipio = $departamento ? Municipio::where('departamento_id', $departamento->id)->first() : null;

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'departamento' => $departamento ? $departamento->nombre : 'Desconocido',
            'municipio' => $municipio ? $municipio->nombre : 'Desconocido',
            'domicilio' => $this->faker->address(),
            'password' => bcrypt('password'),
            'profile_picture' => 'null.jpg',
            'remember_token' => Str::random(10),
        ];
    }
}
