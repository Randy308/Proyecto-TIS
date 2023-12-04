<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionUsuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'calificacion_id',
        'user_id',
        'puntaje',
    ];
}
