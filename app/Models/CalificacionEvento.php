<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionEvento extends Model
{
    use HasFactory;
    protected $fillable = [
        'evento_id',
        'calificacion_id',
        'orden_secuencia',
        'es_promedio',
    ];
}
