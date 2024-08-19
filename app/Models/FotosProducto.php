<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotosProducto extends Model
{
    protected $table = 'fotos_productos';

    protected $fillable = [
        'nombre',
        'id_producto',
    ];
    // Relación inversa con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
