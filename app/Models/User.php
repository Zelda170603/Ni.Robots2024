<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dates = ['last_seen_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'departamento',
        'municipio',
        'domicilio'
    ];

    public function role()
    {
        return $this->hasOne(Role::class);
    }
    
    public function paciente()
    {
        return self::whereHas('role', function ($query) {
            $query->where('role_type', 'paciente');
        })->with('role.roleable')->get();
    }

    public static function fabricantes()
    {
        return self::whereHas('role', function ($query) {
            $query->where('role_type', 'fabricante');
        })->with('role.roleable')->get();
    }
    
    public static function doctoresConEspecialidad($especialidadName)
    {
        return self::whereHas('role', function ($query) {
            $query->where('role_type', 'doctor');
        })
        ->whereHas('role.roleable', function ($query) use ($especialidadName) {
            $query->where('especialidad', $especialidadName);
        })
        ->with([
            'role.roleable' => function ($query) {
                $query->select('id', 'cedula', 'biografia', 'edad', 'genero', 'area', 'especialidad', 'telefono', 'titulacion', 'cod_minsa');
            }
        ])
        ->get();
    }

    


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
