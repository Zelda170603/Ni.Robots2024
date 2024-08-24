<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

<<<<<<< HEAD
        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        //$this->call([ tipo_productos::class]);
        //$this->call(CalificacionProdSeeder::class);
        //$this->call(municipios_departamentosSeeder::class);
        $this->call(ProductoSeeder::class);
        //$this->call(UsersTableSeeder::class);
=======
        $this->call([

            EditorialSeeder::class,
            AutoresSeeder::class,
        ]);

>>>>>>> 9291b3c (PUSH LIBROS)
    }
}
