<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table = 'paciente';

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
    ];

    public function role()
    {
        return $this->morphOne(Role::class, 'roleable');
    }
}
