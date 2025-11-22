<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra;
use App\Models\Compra_producto;
use App\Models\Producto;
use App\Models\User;
use Carbon\Carbon;

class CompraSeeder extends Seeder
{
    /**
     * Permite definir el rango de fechas para las pruebas.
     */
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct()
    {
        // Puedes ajustar fácilmente este rango para tus pruebas 🧠
        $this->fechaInicio = Carbon::now()->subDays(6)->startOfDay(); // hace 6 días
        $this->fechaFin = Carbon::now()->endOfDay();                  // hoy
    }

    public function run(): void
    {
        // Verificamos si existen productos del fabricante 12
        $productosFabricante = Producto::where('id_fabricante', 1)->pluck('id');
        if ($productosFabricante->isEmpty()) {
            $this->command->error("⚠️ No hay productos con id_fabricante = 12. Crea algunos primero.");
            return;
        }

        // Obtenemos un usuario aleatorio (o el primero)
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        // Generar 20 compras
        Compra::factory(20)->create([
            'user_id' => $user->id,
        ])->each(function ($compra) use ($productosFabricante) {
            // Cada compra tendrá entre 3 y 6 productos
            $numProductos = rand(3, 6);

            for ($i = 0; $i < $numProductos; $i++) {
                Compra_producto::create([
                    'compra_id' => $compra->id,
                    'producto_id' => $productosFabricante->random(),
                    'fabricante_id' => 1,
                    'cantidad' => rand(1, 5),
                    'created_at' => $this->fechaAleatoria(),
                    'updated_at' => $this->fechaAleatoria(),
                ]);
            }
        });

        $this->command->info("✅ Se generaron 20 compras con sus productos del fabricante 1.");
    }

    /**
     * Devuelve una fecha aleatoria dentro del rango configurado.
     */
    protected function fechaAleatoria(): Carbon
    {
        return Carbon::createFromTimestamp(
            rand($this->fechaInicio->timestamp, $this->fechaFin->timestamp)
        );
    }
}
