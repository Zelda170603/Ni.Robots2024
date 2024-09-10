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
                'roleable_type' => Doctor::class,
            ]);
        });
    }
}
    