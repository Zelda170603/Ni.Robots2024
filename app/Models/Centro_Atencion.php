<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro_Atencion extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'centro_atencion';

    protected $fillable = [
        'nombre', 'correo', 'telefono', 'direccion', 'ciudad', 'departamento', 'google_map_direction', 'descripcion', 'tipo',
    ];

    public function fotoPrincipal()
    {
        return $this->hasOne(Fotos_Centro_Atencion::class, 'centro_atencion_id')->where('principal', true);
    }

    public function fotosSecundarias()
    {
        return $this->hasMany(Fotos_Centro_Atencion::class, 'centro_atencion_id')->where('principal', false);
    }
}
