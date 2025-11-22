<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAfectacion extends Model
{
    use HasFactory;

    protected $table = 'tipos_afectaciones';

    protected $fillable = [
        'tipo',
        'descripcion',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaAfectacion::class, 'categoria_id');
    }
}