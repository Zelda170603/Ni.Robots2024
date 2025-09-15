<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class municipios_departamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departamentos')->insert([
            ['nombre' => 'Nueva Segovia'],
            ['nombre' => 'León'],
            ['nombre' => 'Chontales'],
            ['nombre' => 'Atlántico Sur'],
            ['nombre' => 'Matagalpa'],
            ['nombre' => 'Granada'],
            ['nombre' => 'Jinotega'],
            ['nombre' => 'Carazo'],
            ['nombre' => 'Madriz'],
            ['nombre' => 'Boaco'],
            ['nombre' => 'Rivas'],
            ['nombre' => 'Estelí'],
            ['nombre' => 'Managua'],
            ['nombre' => 'Chinandega'],
            ['nombre' => 'Masaya'],
            ['nombre' => 'Río San Juan'],
            ['nombre' => 'Atlántico Norte'],
        ]);

        DB::table('municipios')->insert([
            // Nueva Segovia
            ['departamento_id' => 1, 'nombre' => 'Jalapa'],
            ['departamento_id' => 1, 'nombre' => 'Murra'],
            ['departamento_id' => 1, 'nombre' => 'El Jícaro'],
            ['departamento_id' => 1, 'nombre' => 'San Fernando'],
            ['departamento_id' => 1, 'nombre' => 'Mozonte'],
            ['departamento_id' => 1, 'nombre' => 'Dipilto'],
            ['departamento_id' => 1, 'nombre' => 'Macuelizo'],
            ['departamento_id' => 1, 'nombre' => 'Santa María'],
            ['departamento_id' => 1, 'nombre' => 'Ocotal'],
            ['departamento_id' => 1, 'nombre' => 'Ciudad Antigua'],
            ['departamento_id' => 1, 'nombre' => 'Quilalí'],
            ['departamento_id' => 1, 'nombre' => 'Wiwili de Nueva Segovia'],

            // León
            ['departamento_id' => 2, 'nombre' => 'Achuapa'],
            ['departamento_id' => 2, 'nombre' => 'El Sauce'],
            ['departamento_id' => 2, 'nombre' => 'Santa Rosa del Peñón'],
            ['departamento_id' => 2, 'nombre' => 'El Jicaral'],
            ['departamento_id' => 2, 'nombre' => 'Larreynaga'],
            ['departamento_id' => 2, 'nombre' => 'Telica'],
            ['departamento_id' => 2, 'nombre' => 'Quezalguaque'],
            ['departamento_id' => 2, 'nombre' => 'León'],
            ['departamento_id' => 2, 'nombre' => 'La Paz Centro'],
            ['departamento_id' => 2, 'nombre' => 'Nagarote'],

            // Chontales
            ['departamento_id' => 3, 'nombre' => 'Comalapa'],
            ['departamento_id' => 3, 'nombre' => 'San Francisco Cuapa'],
            ['departamento_id' => 3, 'nombre' => 'Juigalpa'],
            ['departamento_id' => 3, 'nombre' => 'La Libertad'],
            ['departamento_id' => 3, 'nombre' => 'Santo Domingo'],
            ['departamento_id' => 3, 'nombre' => 'Santo Tomás'],
            ['departamento_id' => 3, 'nombre' => 'San Pedro de Lóvago'],
            ['departamento_id' => 3, 'nombre' => 'Acoyapa'],
            ['departamento_id' => 3, 'nombre' => 'Villa Sandino'],
            ['departamento_id' => 3, 'nombre' => 'El Coral'],

            // Atlántico Sur
            ['departamento_id' => 4, 'nombre' => 'Paiwas'],
            ['departamento_id' => 4, 'nombre' => 'La Cruz de Río Grande'],
            ['departamento_id' => 4, 'nombre' => 'Desembocadura de Río Grande'],
            ['departamento_id' => 4, 'nombre' => 'Laguna de Perlas'],
            ['departamento_id' => 4, 'nombre' => 'El Tortuguero'],
            ['departamento_id' => 4, 'nombre' => 'Rama'],
            ['departamento_id' => 4, 'nombre' => 'El Ayote'],
            ['departamento_id' => 4, 'nombre' => 'Muelle de los Bueyes'],
            ['departamento_id' => 4, 'nombre' => 'Kukra - Hill'],
            ['departamento_id' => 4, 'nombre' => 'Corn Island'],
            ['departamento_id' => 4, 'nombre' => 'Bluefields'],
            ['departamento_id' => 4, 'nombre' => 'Nueva Guinea'],

            // Matagalpa
            ['departamento_id' => 5, 'nombre' => 'Rancho Grande'],
            ['departamento_id' => 5, 'nombre' => 'Río Blanco'],
            ['departamento_id' => 5, 'nombre' => 'El Tuma - La Dalia'],
            ['departamento_id' => 5, 'nombre' => 'San Isidro'],
            ['departamento_id' => 5, 'nombre' => 'Sébaco'],
            ['departamento_id' => 5, 'nombre' => 'Matagalpa'],
            ['departamento_id' => 5, 'nombre' => 'San Ramón'],
            ['departamento_id' => 5, 'nombre' => 'Matiguás'],
            ['departamento_id' => 5, 'nombre' => 'Muy Muy'],
            ['departamento_id' => 5, 'nombre' => 'Esquipulas'],
            ['departamento_id' => 5, 'nombre' => 'San Dionisio'],
            ['departamento_id' => 5, 'nombre' => 'Terrabona'],
            ['departamento_id' => 5, 'nombre' => 'Ciudad Darío'],

            // Granada
            ['departamento_id' => 6, 'nombre' => 'Diriá'],
            ['departamento_id' => 6, 'nombre' => 'Diriomo'],
            ['departamento_id' => 6, 'nombre' => 'Granada'],
            ['departamento_id' => 6, 'nombre' => 'Nandaime'],

            // Jinotega
            ['departamento_id' => 7, 'nombre' => 'Wiwilí'],
            ['departamento_id' => 7, 'nombre' => 'Cuá-Bocay'],
            ['departamento_id' => 7, 'nombre' => 'San José de Bocay'],
            ['departamento_id' => 7, 'nombre' => 'Sta. María de Pantasma'],
            ['departamento_id' => 7, 'nombre' => 'San Rafael del Norte'],
            ['departamento_id' => 7, 'nombre' => 'San Sebastián de Yalí'],
            ['departamento_id' => 7, 'nombre' => 'La Concordia'],
            ['departamento_id' => 7, 'nombre' => 'Jinotega'],

            // Carazo
            ['departamento_id' => 8, 'nombre' => 'San Marcos'],
            ['departamento_id' => 8, 'nombre' => 'Jinotepe'],
            ['departamento_id' => 8, 'nombre' => 'Dolores'],
            ['departamento_id' => 8, 'nombre' => 'Diriamba'],
            ['departamento_id' => 8, 'nombre' => 'El Rosario'],
            ['departamento_id' => 8, 'nombre' => 'La Paz de Carazo'],
            ['departamento_id' => 8, 'nombre' => 'Santa Teresa'],
            ['departamento_id' => 8, 'nombre' => 'La Conquista'],

            // Madriz
            ['departamento_id' => 9, 'nombre' => 'Somoto'],
            ['departamento_id' => 9, 'nombre' => 'Totogalpa'],
            ['departamento_id' => 9, 'nombre' => 'Telpaneca'],
            ['departamento_id' => 9, 'nombre' => 'San Juan de Río Coco'],
            ['departamento_id' => 9, 'nombre' => 'Palacagüina'],
            ['departamento_id' => 9, 'nombre' => 'Yalagüina'],
            ['departamento_id' => 9, 'nombre' => 'San Lucas'],
            ['departamento_id' => 9, 'nombre' => 'Las Sabanas'],
            ['departamento_id' => 9, 'nombre' => 'San José de Cusmapa'],

            // Boaco
            ['departamento_id' => 10, 'nombre' => 'San José de los Remates'],
            ['departamento_id' => 10, 'nombre' => 'Boaco'],
            ['departamento_id' => 10, 'nombre' => 'Camoapa'],
            ['departamento_id' => 10, 'nombre' => 'Santa Lucía'],
            ['departamento_id' => 10, 'nombre' => 'Teustepe'],
            ['departamento_id' => 10, 'nombre' => 'San Lorenzo'],

            // Rivas
            ['departamento_id' => 11, 'nombre' => 'Tola'],
            ['departamento_id' => 11, 'nombre' => 'Belén'],
            ['departamento_id' => 11, 'nombre' => 'Potosí'],
            ['departamento_id' => 11, 'nombre' => 'Buenos Aires'],
            ['departamento_id' => 11, 'nombre' => 'Moyogalpa'],
            ['departamento_id' => 11, 'nombre' => 'Altagracia'],
            ['departamento_id' => 11, 'nombre' => 'San Jorge'],
            ['departamento_id' => 11, 'nombre' => 'Rivas'],
            ['departamento_id' => 11, 'nombre' => 'San Juan del Sur'],
            ['departamento_id' => 11, 'nombre' => 'Cárdenas'],

            // Estelí
            ['departamento_id' => 12, 'nombre' => 'Pueblo Nuevo'],
            ['departamento_id' => 12, 'nombre' => 'Condega'],
            ['departamento_id' => 12, 'nombre' => 'Estelí'],
            ['departamento_id' => 12, 'nombre' => 'San Juan de Limay'],
            ['departamento_id' => 12, 'nombre' => 'La Trinidad'],
            ['departamento_id' => 12, 'nombre' => 'San Nicolás'],

            // Managua
            ['departamento_id' => 13, 'nombre' => 'San Francisco Libre'],
            ['departamento_id' => 13, 'nombre' => 'Tipitapa'],
            ['departamento_id' => 13, 'nombre' => 'Mateare'],
            ['departamento_id' => 13, 'nombre' => 'Villa Carlos Fonseca'],
            ['departamento_id' => 13, 'nombre' => 'Francisco Javier (C.Sandino)'],
            ['departamento_id' => 13, 'nombre' => 'Managua'],
            ['departamento_id' => 13, 'nombre' => 'Ticuantepe'],
            ['departamento_id' => 13, 'nombre' => 'El Crucero'],
            ['departamento_id' => 13, 'nombre' => 'San Rafael del Sur'],

            // Chinandega
            ['departamento_id' => 14, 'nombre' => 'San Pedro del Norte'],
            ['departamento_id' => 14, 'nombre' => 'San Francisco del Norte'],
            ['departamento_id' => 14, 'nombre' => 'Cinco Pinos'],
            ['departamento_id' => 14, 'nombre' => 'Santo Tomás del Norte'],
            ['departamento_id' => 14, 'nombre' => 'El Viejo'],
            ['departamento_id' => 14, 'nombre' => 'Pto. Morazán'],
            ['departamento_id' => 14, 'nombre' => 'Somotillo'],
            ['departamento_id' => 14, 'nombre' => 'Villanueva'],
            ['departamento_id' => 14, 'nombre' => 'Chinandega'],
            ['departamento_id' => 14, 'nombre' => 'El Realejo'],
            ['departamento_id' => 14, 'nombre' => 'Corinto'],
            ['departamento_id' => 14, 'nombre' => 'Chichigalpa'],
            ['departamento_id' => 14, 'nombre' => 'Posoltega'],

            // Masaya
            ['departamento_id' => 15, 'nombre' => 'Nindirí'],
            ['departamento_id' => 15, 'nombre' => 'Masaya'],
            ['departamento_id' => 15, 'nombre' => 'Tisma'],
            ['departamento_id' => 15, 'nombre' => 'La Concepción'],
            ['departamento_id' => 15, 'nombre' => 'Masatepe'],
            ['departamento_id' => 15, 'nombre' => 'Nandasmo'],
            ['departamento_id' => 15, 'nombre' => 'Catarina'],
            ['departamento_id' => 15, 'nombre' => 'San Juan de Oriente'],
            ['departamento_id' => 15, 'nombre' => 'Niquinohomo'],

            // Río San Juan
            ['departamento_id' => 16, 'nombre' => 'Morrito'],
            ['departamento_id' => 16, 'nombre' => 'El Almendro'],
            ['departamento_id' => 16, 'nombre' => 'San Miguelito'],
            ['departamento_id' => 16, 'nombre' => 'San Carlos'],
            ['departamento_id' => 16, 'nombre' => 'El Castillo'],
            ['departamento_id' => 16, 'nombre' => 'San Juan del Norte'],

            // Atlántico Norte
            ['departamento_id' => 17, 'nombre' => 'Waspán'],
            ['departamento_id' => 17, 'nombre' => 'Puerto Cabezas'],
            ['departamento_id' => 17, 'nombre' => 'Rosita'],
            ['departamento_id' => 17, 'nombre' => 'Bonanza'],
            ['departamento_id' => 17, 'nombre' => 'Waslala'],
            ['departamento_id' => 17, 'nombre' => 'Mulukukú'],
            ['departamento_id' => 17, 'nombre' => 'Siuna'],
            ['departamento_id' => 17, 'nombre' => 'Prinzapolka'],
        ]);
    }
}
