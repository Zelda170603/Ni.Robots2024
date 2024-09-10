<?php

namespace Database\Seeders;

use App\Models\Horarios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<7; ++$i){
            Horarios::create([
                'day' => $i,
            //0 y 1 activo no activo
                'active' => ($i==0),
                'morning_start' => ($i==0 ? '08:00:00' : '07:00:00'),
                'morning_end'=> ($i==0 ? '10:00:00' : '07:00:00'),
                'afternoon_start'=> ($i==0 ? '15:00:00' : '14:00:00'),
                'afternoon_end'=> ($i==0 ? '17:00:00' : '14:00:00'),
                //llave foranea con la relacion a la tabla de usuarios
                'user_id' => 3
            ]);
        }
    }
}
