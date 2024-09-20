<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*  User::factory()->count(10)->create();

        // Crear un usuario con datos personalizados
        User::create([
            'name' => 'Jose Antonio Perez',
            'email' => 'antonio.170603@gmail.com',
            'departamento' => 'Leon',  
            'municipio' => 'Leon',     
            'domicilio' => 'Calle Falsa 123',
            'password' => bcrypt('zelda123'),  
            'profile_picture' => 'null.jpg', 
        ]);*/

        $user = User::create([
            'name' => 'Pavel Rodriguez',
            'email' => 'pavel@gmail.com',
            'departamento' => 'Leon',  
            'municipio' => 'Leon',     
            'domicilio' => 'Calle Falsa 123',
            'password' => bcrypt('zelda123'),  
            'profile_picture' => 'null.jpg', 
        ]);

        Role::create([
            'user_id' => $user->id,
            'roleable_id' => $user->id,
            'role_type' => 'administrador',
            'roleable_type' => User::class,
        ]);
    }
}
