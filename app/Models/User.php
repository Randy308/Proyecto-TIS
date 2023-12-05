<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
        'direccion',
        'instituto',
        'direccion_foto',
        'historial_Academico',
        'fecha_nac',
        'estado',
        'institucion_id',//observacion
        'pais',
        'historial_academico',
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

    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
    public function grupos_pertenecen_grupos()
    {
        return $this->belongsToMany(Grupo::class, 'pertenecen_grupos');
    }
    public function eventosColabora()
    {
        return $this->belongsToMany(Evento::class, 'colaboradors');
    }

    public function asistencias() {
        return $this->hasMany(Asistencia::class, 'user_id');
    }

    public function notificaciones() {
        return $this->hasManyThrough(Notificacion::class, AsistenciaEvento::class, 'user_id', 'asistencia_id');
    }
}
