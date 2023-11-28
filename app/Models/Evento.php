<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ImagenAuspiciador;
class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_evento',
        'descripcion_evento',
        'estado',
        'user_id',
        'fecha_inicio',
        'fecha_fin',
        'background_color',
        'direccion_banner',
        'privacidad',
        'cantidad_minima',
        'cantidad_maxima',
        'tipo_evento',
        'latitud',
        'longitud',
        'costo',
        'institucion',
        'tiempo_inicio',
        'tiempo_fin',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'asistencia_eventos');
    }

    public function elementosBanners()
    {
        return $this->hasMany(ElementosBanner::class);
    }
    public function elementoImagenBanners()
    {
        return $this->hasMany(ElementoImagenBanner::class);
    }
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
    public function fases(){
        return $this->hasMany(Fase::class);
    }
    
    public function auspiciadors()
    {
        return $this->belongsToMany(Auspiciador::class, 'auspiciador_eventos');
    }
    public function colaboradors()
    {
        return $this->belongsToMany(User::class, 'colaboradors');
    }
    public function pertenecenGrupos(){
        return $this->hasMany(PertenecenGrupo::class);
    }
}
