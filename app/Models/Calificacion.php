<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nota_minima_aprobacion',
        'nota_maxima',
    ];
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'calificacion_usuarios');
    }
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'calificacion_eventos');
    }

}
