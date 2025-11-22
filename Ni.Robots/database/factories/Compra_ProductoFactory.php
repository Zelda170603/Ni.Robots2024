<?php

namespace Database\Factories;

use App\Models\Compra_producto;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class Compra_ProductoFactory extends Factory
{
    protected $model = Compra_producto::class;

    public function definition(): array
    {
        return [
            // 🔹 Selecciona una compra existente o crea una nueva si no hay
            'compra_id' => Compra::inRandomOrder()->value('id') ?? Compra::factory(),

            // 🔹 Selecciona un producto que pertenezca al fabricante con id = 12
            //    Si no existen productos con fabricante_id = 12, crea uno nuevo con ese fabricante.
            'producto_id' => Producto::where('id_fabricante', 12)->inRandomOrder()->value('id')
                ?? Producto::factory()->state(['id_fabricante' => 12]),

            // 🔹 Asigna siempre el fabricante con id = 12
            'fabricante_id' => 12,

            // 🔹 Cantidad aleatoria entre 1 y 5
            'cantidad' => $this->faker->numberBetween(1, 5),
        ];
    }
}
