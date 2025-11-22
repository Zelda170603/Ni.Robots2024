<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait HasFactory
use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    use HasFactory; // Usa el trait HasFactory

    protected $table = 'fabricantes';

    protected $fillable = [
        'nombre',
        'foto_fabr',
        'ubicacion',
        'direccion',
        'correo',
        'telefono',
        'unique_id',
        'descripcion',
        'google_map_direction',
    ];

    public function role()
    {
        return $this->morphOne(Role::class, 'roleable');
    }
}
