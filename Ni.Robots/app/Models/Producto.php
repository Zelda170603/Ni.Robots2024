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
    
    public function carritos()
    {
        return $this->hasMany(Carrito::class);
    }
    public function calificaciones()
    {
        return $this->hasMany(CalificacionProd::class, 'id_prod', 'id');
    }
    // Función para obtener el promedio de calificaciones
    public function getAverageRatingAttribute()
    {
        return $this->calificaciones()->avg('puntuacion');
    }

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class, 'id_fabricante');
    } 

    public function compras()
    {
        return $this->hasMany(Compra_producto::class, 'producto_id');
    }

    // Método para calcular las ventas totales
    public function totalVentas()
    {
        return $this->compras()->sum('cantidad');
    }
    // Método para calcular las ventas del último mes
    public function ventasUltimoMes()
    {
        return $this->compras()
            ->where('created_at', '>=', now()->subMonth()) // Filtra por el último mes
            ->sum('cantidad'); // Suma la cantidad vendida en el último mes
    }

    protected static function booted()
    {
        static::deleting(function ($producto) {
            // Eliminar las fotos asociadas cuando se elimina un producto
            $producto->fotos()->delete();
        });
    }
}
