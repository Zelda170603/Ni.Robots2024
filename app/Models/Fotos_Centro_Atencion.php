<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotos_Centro_Atencion extends Model
{   
    protected $table = 'fotos_centro_atencion';

    protected $fillable = [
        'nombre',
        'id_centro', // Cambiado a 'id_centro'
    ];

    public function centroAtencion()
    {
        return $this->belongsTo(Centro_Atencion::class, 'id_centro'); // Cambiado a 'id_centro'
    }
}


