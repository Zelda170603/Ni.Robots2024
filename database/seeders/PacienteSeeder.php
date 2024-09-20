<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Paciente;
use App\Models\User;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* 
        // Generar 10 usuarios y asociarlos con pacientes aleatorios
        User::factory()
            ->count(10)
            ->create()
            ->each(function (User $user) {
                // Crear un paciente aleatorio
                $paciente = Paciente::factory()->create();

                // Crear un rol 'paciente' para el usuario y asociarlo al paciente
                Role::factory()->create([
                    'user_id' => $user->id,
                    'roleable_id' => $paciente->id,
                    'role_type' => 'paciente',
                    'roleable_type' => Paciente::class,
                ]);
            });
*/
        // Crear un paciente con datos personalizados
        $customUser = User::create([
            'name' => 'Maria Daniela',
            'email' => 'daniela@gmail.com',
            'departamento' => 'Granada',
            'municipio' => 'Granada',
            'domicilio' => 'Avenida Central, Granada',
            'password' => bcrypt('zelda123'),
            'profile_picture' => 'null.jpg',
        ]);

        $categoria = DB::table('categorias_afectaciones')
            ->select('id', 'nombre')
            ->inRandomOrder()
            ->first();

        // Seleccionar un tipo de afectación basado en la categoría seleccionada
        $tipoAfectacion = $categoria ? DB::table('tipos_afectaciones')
            ->where('categoria_id', $categoria->id)
            ->inRandomOrder()
            ->first() : null;

        // Crear el paciente asociado con los datos personalizados
        $customPaciente = Paciente::create([
            'cedula' => '123-456789-2023P',
            'biografia' => 'Paciente con antecedentes de hipertensión.',
            'edad' => 40,
            'peso' => 75,
            'altura' => 170,
            'genero' => 'masculino',
            'condicion' => 'Hipertensión controlada',
            'tipo_afectacion' => $categoria->nombre,
            'nivel_afectacion' => $tipoAfectacion->tipo,
        ]);

        // Crear el rol 'paciente' para este usuario y paciente personalizado
        Role::create([
            'user_id' => $customUser->id,
            'roleable_id' => $customPaciente->id,
            'role_type' => 'paciente',
            'roleable_type' => Paciente::class,
        ]);
    }
}
