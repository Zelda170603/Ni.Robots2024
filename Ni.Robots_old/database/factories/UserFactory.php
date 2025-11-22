<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departamento = DB::table('departamentos')
            ->select('id', 'nombre')
            ->inRandomOrder()
            ->first();


        $municipio = DB::table('municipios')
            ->where('departamento_id', $departamento->id)
            ->select('nombre')
            ->inRandomOrder()
            ->first();
            
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'departamento' => $departamento->nombre,
            'municipio' => $municipio->nombre,
            'domicilio' => $this->faker->address(),
            'password' => bcrypt('password'),
            'profile_picture' => 'null.jpg',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
