<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_evento',
        'descripcion_evento',
        'user_id',
        'estado',
        'categoria',
        'fecha_inicio',
        'fecha_fin',
        'background_color',
        'direccion_banner',
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
}
