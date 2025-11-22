<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;
use App\Models\Fabricante;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Producto::class;

    public function definition()
    {
        $categoria = DB::table('categorias_afectaciones')
    ->select('id', 'nombre')
    ->inRandomOrder()
    ->first();

$tipoAfectacion = $categoria
    ? DB::table('tipos_afectaciones')
        ->where('categoria_id', $categoria->id)
        ->inRandomOrder()
        ->first()
    : null;

$fabricante = Fabricante::inRandomOrder()->first();

return [
    'nombre_prod' => $this->faker->word,
    'unique_id' => Str::random(7),
    'descripcion' => $this->faker->sentence,
    'foto_prod' => $this->faker->imageUrl(640, 480, 'products', true, 'Faker'),
    'precio' => $this->faker->randomFloat(2, 10, 1000),
    'color' => $this->faker->safeColorName,
    'tipo_afectacion' => $categoria->nombre ?? 'Sin categoría',
    'nivel_afectacion' => $tipoAfectacion->tipo ?? 'Sin nivel',
    'grupo_usuarios' => $this->faker->randomElement(['niños', 'adultos', 'ancianos']),
    'existencias' => $this->faker->numberBetween(1, 100),
    'tipo_producto' => $this->faker->randomElement(['protesis', 'ortesis', 'ortopedicos']),
    'id_fabricante' => $fabricante->id ?? 12, // 1 como fallback si no hay fabricante
];

    }
}
