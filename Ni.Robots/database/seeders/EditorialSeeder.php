<?php

namespace Database\Seeders;

use App\Models\Editoriale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Editoriale::factory()->count(10)->create();
    }
}
