<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionGrupo extends Model
{
    use HasFactory;
    protected $fillable = [
        'calificacion_id',
        'grupo_id',
        'puntaje',
        'evento_id',
    ];
}
