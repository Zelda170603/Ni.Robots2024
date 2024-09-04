<?php

namespace Database\Factories;

use App\Models\Fabricante;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FabricanteFactory extends Factory
{
    /**
     * El nombre del modelo correspondiente al factory.
     *
     * @var string
     */
    protected $model = Fabricante::class;

    /**
     * Define la estructura por defecto para el modelo.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_id' => Str::uuid(),
            'nombre' => $this->faker->company,
            'foto_fabr' => $this->faker->imageUrl(),
            'ubicacion' => $this->faker->address,
            'descripcion' => $this->faker->paragraph,
            'direccion' => $this->faker->streetAddress,
            'google_map_direction' => $this->faker->url,
            'telefono' => 50583772329,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
