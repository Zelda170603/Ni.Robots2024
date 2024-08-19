<?php

namespace Database\Seeders;

use App\Models\CalificacionProd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
Use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class CalificacionProdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los usuarios y productos
        $users = User::all();
        $products = Producto::all();

        // Asegurarse de que haya usuarios y productos disponibles
        if ($users->isEmpty() || $products->isEmpty()) {
            throw new \Exception('No hay usuarios o productos disponibles para crear calificaciones.');
        }

        foreach ($users as $user) {
            foreach ($products as $product) {
                CalificacionProd::create([
                    'puntuacion' => rand(1, 5),
                    'comentario' => 'Comentario de prueba para el producto ' . $product->id,
                    'id_prod' => $product->id,
                    'id_user' => $user->id,
                ]);
            }
        }
    }
}
