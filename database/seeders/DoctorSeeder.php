<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->create()
            ->each(function (User $user) {
                // Create a patient and associate it with the user
                $doctor = Doctor::factory()->create();
                // Create the role and associate it with the user and patient
                Role::factory()->create([
                    'user_id' => $user->id,
                    'roleable_id' => $doctor->id,
                    'role_type' => "doctor",
                    'roleable_type' => Doctor::class,
                ]);
            });

        // Crear un doctor con datos específicos
        $customUser = User::create([
            'name' => 'Marcos Alonso',
            'email' => 'marcos@gmail.com',
            'departamento' => 'Managua',  // Datos personalizados para el usuario
            'municipio' => 'Managua',
            'domicilio' => 'Calle 123, Managua',
            'password' => bcrypt('zelda123'),
            'profile_picture' => 'null.jpg',
            // Otros campos que desees agregar
        ]);

        // Crear el doctor asociado con los datos específicos
        $customDoctor = Doctor::create([
            'cedula' => '123-456789-2023J',
            'biografia' => 'Médico con amplia experiencia en cirugía.',
            'edad' => 45,
            'genero' => 'masculino',
            'area' => 'Cirugía',
            'especialidad' => 'Cirujano',  // Puede coincidir con alguna especialidad
            'telefono' => '88888888',
            'titulacion' => 'Doctor en Medicina',
            'cod_minsa' => 'XYZ123',
        ]);

        // Crear el rol para este usuario y doctor personalizado
        Role::create([
            'user_id' => $customUser->id,
            'roleable_id' => $customDoctor->id,
            'role_type' => 'doctor',
            'roleable_type' => Doctor::class,
        ]);
    }
}
