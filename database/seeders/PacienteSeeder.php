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
        User::factory()
            ->count(10)
            ->create()
            ->each(function (User $user) {
                // Create a patient and associate it with the user
                $paciente = Paciente::factory()->create();

                // Create the role and associate it with the user and patient
                Role::factory()->create([
                    'user_id' => $user->id,
                    'roleable_id' => $paciente->id,
                    'roleable_type' => Paciente::class,
                ]);
            });
    }
}
