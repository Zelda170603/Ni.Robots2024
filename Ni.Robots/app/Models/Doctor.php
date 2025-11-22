<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctor';

    protected $fillable = [
        'cedula',
        'biografia',
        'edad',
        'genero',
        'area',
        'especialidad',
        'telefono',
        'direccion_consultorio',
        'google_map_direction',
        'titulacion',
        'cod_minsa'
    ];

    public function role()
    {
        return $this->morphOne(Role::class, 'roleable');
    }
    
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    // Add this relationship
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}