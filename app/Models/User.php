<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rol;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
        'telefono',
        'direccion',
        'carrera',
        'foto_perfil',
        'fecha_nac',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function eventosParticipa()
    {
        return $this->belongsToMany(Evento::class, 'asistencia_eventos');
    }

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
    public function institucions()
    {
        return $this->belongsTo(Institucion::class);
    }
}
