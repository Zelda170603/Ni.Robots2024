<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $perPage = 20;

    protected $fillable = [
        'title',
        'file_url',
        'autor_id',
        'categoria',
        'grupo_usuarios',
        'editorial_id',
        'portada',
        'descripcion',
        'fecha_publicacion',
        'isbn',
        'paginas'
    ];

    public function autor()
    {
        return $this->belongsTo(Autore::class, 'autor_id', 'id');
    }
    
    public function editorial()
    {
        return $this->belongsTo(Editoriale::class, 'editorial_id', 'id');
    }

    public function calificaciones()
    {
        return $this->hasMany(CalificacionBook::class, 'id_book', 'id');
    }

    /**
     * CORREGIDO: Accesor para la portada
     */
    public function getPortadaUrlAttribute()
    {
        if (!$this->portada) {
            return asset('images/default-book.jpg');
        }

        // Si ya tiene 'storage/' en la BD, usar directamente
        return asset($this->portada);
    }

    /**
     * CORREGIDO: Accesor para el PDF - VERSIÓN SIMPLIFICADA
     */
    public function getFileUrlAttribute()
    {
        $value = $this->attributes['file_url'];
        
        if (!$value) {
            return null;
        }

        // Si ya es una URL completa, retornar directamente
        if (str_starts_with($value, 'http')) {
            return $value;
        }

        // Si ya incluye 'storage/', usar asset directamente
        if (str_starts_with($value, 'storage/')) {
            return asset($value);
        }

        // Si es solo el nombre del archivo, construir la ruta completa
        return asset('storage/librosPDF/' . $value);
    }
}