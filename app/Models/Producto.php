<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $table = 'productos';

    protected $fillable = [
        'nombre_prod',
        'unique_id',
        'descripcion',
        'foto_prod',
        'precio',
        'color',
        'tipo_afectacion',
        'nivel_afectacion',
        'grupo_usuarios',
        'existencias',
        'tipo_producto',
        'id_fabricante',
    ];

    public function fotos()
    {
        return $this->hasMany(FotosProducto::class, 'id_producto');
    }
    // Relación con Fabricante
    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class, 'id_fabricante');
    }
    public function carritos()
    {
        return $this->hasMany(Carrito::class);
    }
    public function calificaciones()
    {
        return $this->hasMany(CalificacionProd::class, 'id_prod', 'id');
    }

    protected static function booted()
    {
        static::deleting(function ($producto) {
            // Eliminar las fotos asociadas cuando se elimina un producto
            $producto->fotos()->delete();
        });
    }
}
