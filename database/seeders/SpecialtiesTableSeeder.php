<?php

namespace Database\Seeders;

use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            'Neurologia',
            'Quirurgica',
            'Pediatria',
            'Cardiologia',
            'Urologia',
            'Dermatologia',
            'Ortopedia'
        ];
        foreach ($specialties as $specialtyName) {
            Specialty::create([
                'name' => $specialtyName
            ]);
        }
    }
}
