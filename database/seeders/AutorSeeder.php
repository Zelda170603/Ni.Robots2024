<?php

namespace Database\Seeders;

use App\Models\Autore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Autore::factory()->count(10)->create();
    }
}
