<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Autore
 *
 * @property $id
 * @property $nombre
 * @property $apellido
 * @property $fecha_nacimiento
 * @property $fecha_fallecimiento
 * @property $nacionalidad
 * @property $biografia
 * @property $created_at
 * @property $updated_at
 *
 * @property Book[] $books
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Autore extends Model
{
    use HasFactory;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'apellido', 'fecha_nacimiento', 'fecha_fallecimiento', 'nacionalidad', 'biografia'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(\App\Models\Book::class, 'id', 'autor_id');
    }
    
}
