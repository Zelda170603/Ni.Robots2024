<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionBook extends Model
{
    use HasFactory;
    protected $table = 'calificacion_book';
    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'puntuacion',
        'comentario',
        'id_book',
        'id_user',
    ];
    public $timestamps = true;

    // Definir la relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Book::class, 'id_book', 'id');
    }

    // Definir la relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
