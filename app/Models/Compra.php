<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';

    protected $fillable = [
        'user_id',
        'compra_id',
        'carrito_id',
        'total',
        'status',
        'paypal_order_id',
    ];

    public function compraProductos()
    {
        return $this->hasMany(Compra_Producto::class, 'compra_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
