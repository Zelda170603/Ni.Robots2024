<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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
    ];
    
    public function role()
    {
        return $this->hasOne(Role::class);
    }
    
    public static function fabricantes()
    {
        return self::whereHas('role', function ($query) {
            $query->where('role_type', 'fabricante');
        })->with('role.roleable')->get();
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
