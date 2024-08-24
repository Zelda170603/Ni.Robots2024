<?php

namespace App\Models;

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
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'file_url', 'autor_id', 'editorial_id', 'portada', 'descripcion', 'fecha_publicacion', 'isbn', 'paginas'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autore()
    {
        return $this->belongsTo(\App\Models\Autore::class, 'autor_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function editoriale()
    {
        return $this->belongsTo(\App\Models\Editoriale::class, 'editorial_id', 'id');
    }
    
}
