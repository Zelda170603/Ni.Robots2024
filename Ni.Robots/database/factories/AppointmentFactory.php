<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        return [
            'scheduled_date' => $this->faker->date(), // Fecha programada
            'scheduled_time' => $this->faker->time(), // Hora programada
            'type' => $this->faker->randomElement(['Consulta', 'Revisión', 'Seguimiento', 'Urgencia']), // Tipo de cita
            'description' => $this->faker->sentence(), // Descripción de la cita
            'status' => $this->faker->randomElement(['Reservada', 'Cancelada', 'Completada']), // Estado de la cita
            'doctor_id' => Doctor::inRandomOrder()->first()->id, // ID del doctor al azar
            'patient_id' => Paciente::inRandomOrder()->first()->id, // ID del paciente al azar
            'specialty' => $this->faker->word(), // Especialidad
        ];
    }
}
