<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra_producto extends Model
{
    use HasFactory;
    
    protected $table = 'compra_productos';

    protected $fillable = [
        'compra_id',
        'producto_id',
        'fabricante_id',
        'cantidad',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }
}
