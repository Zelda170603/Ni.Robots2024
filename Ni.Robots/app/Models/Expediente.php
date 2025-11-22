<?php
// app/Models/Expediente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'diagnostico',
        'tratamiento',
        'medicamentos',
        'notas_adicionales',
        'presion_arterial',
        'temperatura',
        'frecuencia_cardiaca',
        'frecuencia_respiratoria',
        'peso',
        'altura',
        'tipo_sangre',
        'alergias',
        'enfermedades_cronicas',
        'cirugias_previas',
        'medicamentos_actuales',
        'historial_familiar'
    ];

    // Relación con el paciente
    public function patient()
    {
        return $this->belongsTo(Paciente::class, 'patient_id');
    }

    // Relación con el doctor
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Relación con el usuario paciente (a través del paciente)
    public function user()
    {
        return $this->hasOneThrough(User::class, Paciente::class, 'id', 'id', 'patient_id', 'id');
    }
}