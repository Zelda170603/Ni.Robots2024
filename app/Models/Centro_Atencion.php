<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro_Atencion extends Model
{
    protected $table = 'centro_atencion';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'direccion',
        'foto_centro',
        'departamento',
        'municipio',
        'google_map_direction',
        'descripcion',
        'tipo',
    ];

    public function fotos()
    {
        return $this->hasMany(Fotos_Centro_Atencion::class, 'id_centro');
    }
}

