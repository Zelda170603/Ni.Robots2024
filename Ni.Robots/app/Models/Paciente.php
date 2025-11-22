<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table = 'pacientes';

    protected $fillable = [
        'cedula',
        'biografia',
        'edad',
        'peso',
        'altura',
        'genero',
        'condicion',
        'tipo_afectacion',
        'nivel_afectacion',
        'telefono' // Asegúrate de que este campo existe
    ];

    public function role()
    {
        return $this->morphOne(Role::class, 'roleable');
    }

    public function user()
    {
        return $this->hasOneThrough(
            User::class, 
            Role::class, 
            'roleable_id', // Foreign key on roles table
            'id',           // Foreign key on users table  
            'id',           // Local key on pacientes table
            'user_id'       // Local key on roles table
        )->where('roles.roleable_type', self::class);
    }

    // Relación con las citas
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}