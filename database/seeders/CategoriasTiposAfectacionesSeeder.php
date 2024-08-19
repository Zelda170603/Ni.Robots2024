<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTiposAfectacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar datos en la tabla categorias
        DB::table('categorias_afectaciones')->insert([
            ['nombre' => 'Miembros Superiores'],
            ['nombre' => 'Miembros Inferiores'],
            ['nombre' => 'Movilidad Reducida']
        ]);

        // Obtener los IDs de las categorías
        $superiorId = DB::table('categorias_afectaciones')->where('nombre', 'Miembros Superiores')->value('id');
        $inferiorId = DB::table('categorias_afectaciones')->where('nombre', 'Miembros Inferiores')->value('id');
        $movilidadId = DB::table('categorias_afectaciones')->where('nombre', 'Movilidad Reducida')->value('id');
        // Insertar datos en la tabla tipos_afectaciones para Miembros Superiores
        DB::table('tipos_afectaciones')->insert([
            ['tipo' => 'Amputación Transradial', 'descripcion' => 'Pérdida del antebrazo por debajo del codo.', 'categoria_id' => $superiorId],
            ['tipo' => 'Amputación Transhumeral', 'descripcion' => 'Pérdida del brazo por encima del codo.', 'categoria_id' => $superiorId],
            ['tipo' => 'Amputación Transcarpal', 'descripcion' => 'Pérdida de la mano a nivel de la muñeca.', 'categoria_id' => $superiorId],
            ['tipo' => 'Amputación Transmetacarpiana', 'descripcion' => 'Pérdida de una parte de la mano, incluyendo los metacarpos (huesos de la palma).', 'categoria_id' => $superiorId],
            ['tipo' => 'Amputación Digitocarpal', 'descripcion' => 'Pérdida de uno o más dedos de la mano.', 'categoria_id' => $superiorId],
            ['tipo' => 'Parálisis del Plexo Braquial', 'descripcion' => 'Afectación que causa pérdida de movimiento y sensibilidad en el brazo debido a daño en los nervios del plexo braquial.', 'categoria_id' => $superiorId],
            ['tipo' => 'Limitación de Movimiento (Articulaciones)', 'descripcion' => 'Rigidez o pérdida de movilidad en el codo, muñeca, o dedos, debido a condiciones como artritis, lesiones traumáticas, o enfermedades degenerativas.', 'categoria_id' => $superiorId],
            ['tipo' => 'Contracturas Musculares', 'descripcion' => 'Deformidades causadas por la contracción permanente de los músculos en el brazo o mano.', 'categoria_id' => $superiorId],
            ['tipo' => 'Pérdida Sensorial', 'descripcion' => 'Reducción o ausencia de sensibilidad en el brazo, mano o dedos, debido a daño nervioso o condiciones como neuropatías.', 'categoria_id' => $superiorId],
        ]);

        // Insertar datos en la tabla tipos_afectaciones para Miembros Inferiores
        DB::table('tipos_afectaciones')->insert([
            ['tipo' => 'Amputación Transtibial', 'descripcion' => 'Pérdida de la pierna por debajo de la rodilla.', 'categoria_id' => $inferiorId],
            ['tipo' => 'Amputación Transfemoral', 'descripcion' => 'Pérdida de la pierna por encima de la rodilla.', 'categoria_id' => $inferiorId],
            ['tipo' => 'Amputación Transmetatarsiana', 'descripcion' => 'Pérdida parcial del pie, incluyendo los metatarsianos (huesos del pie).', 'categoria_id' => $inferiorId],
            ['tipo' => 'Amputación Transfemoropatelar', 'descripcion' => 'Pérdida del miembro a través de la rodilla y la rótula.', 'categoria_id' => $inferiorId],
            ['tipo' => 'Amputación Digital (Pie)', 'descripcion' => 'Pérdida de uno o más dedos del pie.', 'categoria_id' => $inferiorId],
            ['tipo' => 'Parálisis o Pérdida de Movimiento (Paraplejia)', 'descripcion' => 'Afectación que provoca pérdida de movimiento en las piernas debido a daño en la médula espinal.', 'categoria_id' => $inferiorId],
            ['tipo' => 'Limitación de Movimiento (Articulaciones)', 'descripcion' => 'Rigidez o pérdida de movilidad en la cadera, rodilla, o tobillo, debido a condiciones como artritis, lesiones traumáticas, o enfermedades degenerativas.', 'categoria_id' => $inferiorId],
            ['tipo' => 'Pie Equino', 'descripcion' => 'Deformidad en la cual el pie se encuentra en una posición de flexión plantar permanente.', 'categoria_id' => $inferiorId],
            ['tipo' => 'Contracturas Musculares', 'descripcion' => 'Deformidades causadas por la contracción permanente de los músculos en las piernas.', 'categoria_id' => $inferiorId],
            ['tipo' => 'Pérdida Sensorial', 'descripcion' => 'Reducción o ausencia de sensibilidad en la pierna o pie, debido a daño nervioso o condiciones como neuropatías.', 'categoria_id' => $inferiorId],
        ]);

        // Insertar datos en la tabla tipos_afectaciones para Movilidad Reducida
        DB::table('tipos_afectaciones')->insert([
            ['tipo' => 'Paraplejia', 'descripcion' => 'Pérdida de la función motora en las extremidades inferiores, lo que a menudo requiere el uso de una silla de ruedas.', 'categoria_id' => $movilidadId],
            ['tipo' => 'Tetraplejia', 'descripcion' => 'Pérdida de la función motora en las cuatro extremidades, generalmente requiere el uso de una silla de ruedas.', 'categoria_id' => $movilidadId],
            ['tipo' => 'Esclerosis Múltiple Avanzada', 'descripcion' => 'Condición que puede limitar severamente la movilidad, a menudo requiere el uso de dispositivos de asistencia como sillas de ruedas.', 'categoria_id' => $movilidadId],
            ['tipo' => 'Distrofia Muscular', 'descripcion' => 'Grupo de enfermedades que causan debilidad progresiva y pérdida de masa muscular, a menudo requieren el uso de silla de ruedas en etapas avanzadas.', 'categoria_id' => $movilidadId],
        ]);
    }
}
