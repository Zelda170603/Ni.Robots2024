<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Paciente;
use App\Models\User;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        // Crear un usuario personalizado
        $customUser = User::create([
            'name' => 'Maria Daniela',
            'email' => 'daniela@gmail.com',
            'departamento' => 'Granada',
            'municipio' => 'Granada',
            'domicilio' => 'Avenida Central, Granada',
            'password' => bcrypt('zelda123'),
            'profile_picture' => 'null.jpg',
        ]);

        // Seleccionar una categoría de afectación al azar
        $categoria = DB::table('categorias_afectaciones')
            ->inRandomOrder()
            ->first();

        // Seleccionar un tipo de afectación basado en la categoría seleccionada (si existe)
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
            'tipo_afectacion' => $categoria->nombre ?? 'Sin categoría',
            'nivel_afectacion' => $tipoAfectacion->tipo ?? 'Sin nivel',
        ]);

        // Crear el rol 'paciente' para este usuario y paciente
        Role::create([
            'user_id' => $customUser->id,
            'roleable_id' => $customPaciente->id,
            'role_type' => 'paciente',
            'roleable_type' => Paciente::class,
        ]);
    }
}
