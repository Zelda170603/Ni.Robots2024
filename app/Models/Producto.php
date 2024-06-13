<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre_prod',
        'descripcion',
        'foto_prod',
        'precio',
        'color',
        'nivel_afectacion', // Asegúrate de que este campo se llama "nivel_amputacion"
        'grupo_usuarios',
        'existencias',
        'id_tipo_producto',
        'id_fabricante',
    ];

    // Relación con TipoProducto
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'id_tipo_producto');
    }
    // Relación con Fabricante
    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class, 'id_fabricante');
    }
}
