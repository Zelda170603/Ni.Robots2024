<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 *
 * @property $id
 * @property $title
 * @property $file_url
 * @property $autor_id
 * @property $editorial_id
 * @property $portada
 * @property $descripcion
 * @property $fecha_publicacion
 * @property $isbn
 * @property $paginas
 * @property $created_at
 * @property $updated_at
 *
 * @property Autore $autore
 * @property Editoriale $editoriale
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Book extends Model
{
    use HasFactory;
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'file_url', 'autor_id', 'categoria', 'grupo_usuarios', 'editorial_id', 'portada', 'descripcion', 'fecha_publicacion', 'isbn', 'paginas'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autor()
    {
        return $this->belongsTo(Autore::class, 'autor_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function editorial()
    {
        return $this->belongsTo(Editoriale::class, 'editorial_id', 'id');
    }
    public function calificaciones()
    {
        return $this->hasMany(CalificacionBook::class, 'id_book', 'id');
    }
}
