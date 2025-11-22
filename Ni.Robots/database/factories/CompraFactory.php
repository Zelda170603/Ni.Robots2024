<?php

namespace Database\Factories;

use App\Models\Compra;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class CompraFactory extends Factory
{
    protected $model = Compra::class;

    public function definition(): array
    {
        $fecha = Carbon::now()->subDays(6)->addDays(rand(0, 6))
            ->setTime(rand(0, 23), rand(0, 59), rand(0, 59));

        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(), 
            'compra_id' => strtoupper(Str::random(10)),
            'carrito_id' => null,
            'total' => $this->faker->randomFloat(2, 50, 500),
            'status' => $this->faker->randomElement(['pendiente', 'pagado', 'enviado']),
            'paypal_order_id' => strtoupper(Str::random(10)),
            'created_at' => $fecha,
            'updated_at' => $fecha,
        ];
    }
}

