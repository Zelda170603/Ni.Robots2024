<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaAfectacion extends Model
{
    use HasFactory;

    protected $table = 'categorias_afectaciones';

    protected $fillable = [
        'nombre',
        'descripcion', // Asumiendo campos comunes; ajusta según tu DB
    ];

    public function tipos()
    {
        return $this->hasMany(TipoAfectacion::class, 'categoria_id');
    }
}