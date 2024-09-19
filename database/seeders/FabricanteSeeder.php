<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fabricante;
use App\Models\User;
use App\Models\Role;

class FabricanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generar 10 usuarios y asociarlos con fabricantes aleatorios
        User::factory()
            ->count(10)
            ->create()
            ->each(function (User $user) {
                // Crear un fabricante aleatorio
                $fabricante = Fabricante::factory()->create();
                // Crear un rol 'fabricante' para el usuario y asociarlo al fabricante
                Role::factory()->create([
                    'user_id' => $user->id,
                    'roleable_id' => $fabricante->id,
                    'role_type' => 'fabricante',
                    'roleable_type' => Fabricante::class,
                ]);
            });

        // Crear un fabricante con datos personalizados
        $customUser = User::factory()->create([
            'email' => 'apple@gmail.com',
            'password' => bcrypt('zelda123'),
            'profile_picture' => 'null.jpg',
        ]);

        // Crear el fabricante asociado con los datos personalizados
        $customFabricante = Fabricante::factory()->create([
            'unique_id' => 'FAB-123456',
            'nombre' => 'Apple',
            'foto_fabr' => 'fabricante_ramirez.jpg',
            'ubicacion' => 'Managua, Nicaragua',
            'descripcion' => 'Fabricante especializado en productos electrónicos.',
            'direccion' => 'Calle Principal, Managua',
            'google_map_direction' => 'https://maps.google.com/.../managua-location',
            'telefono' => 88887777,
        ]);

        // Crear el rol 'fabricante' para este usuario y fabricante personalizado
        Role::factory()->create([
            'user_id' => $customUser->id,
            'roleable_id' => $customFabricante->id,
            'role_type' => 'fabricante',
            'roleable_type' => Fabricante::class,
        ]);
    }
}
