<?php

namespace Database\Seeders;

use App\Models\Compra;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Municipios y departamentos
        //$this->call(municipios_departamentosSeeder::class);

        // Categorías y tipos de afectaciones
        //$this->call(CategoriasTiposAfectacionesSeeder::class);

        // Usuarios (fake está bien)
        //$this->call(UsersTableSeeder::class);

        // Pacientes
        //$this->call(PacienteSeeder::class);

        // Especialidades
        //$this->call(SpecialtiesTableSeeder::class);

        // Doctores
        //$this->call(DoctorSeeder::class);

        // $this->call(Compra_productoSeeder::class);
        //$this->call(CompraSeeder::class);
        // Citas / Appointments
        //$this->call(AppointmentsTablesSeeder::class);

        // Seeders de libros y productos se excluyen para no cargar datos fake
        // $this->call(ProductoSeeder::class);
        // $this->call(bookseeder::class);
        // $this->call(AutorSeeder::class);
        // $this->call(EditorialSeeder::class);
        $this->call(CompraSeeder::class);
        // $this->call(CalificacionProdSeeder::class);
        // $this->call(CalificacionBookSeeder::class);
    }
}
