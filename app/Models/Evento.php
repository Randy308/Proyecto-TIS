<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'Titulo',
        'DireccionImg', // Agrega la columna DireccionImg al arreglo fillable
        'Descripcion',
        'Estado',
        'FechaInicio',
        'FechaFin',
    ];
}
