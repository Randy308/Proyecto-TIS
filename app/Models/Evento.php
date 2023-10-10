<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_evento',
        'descripcion_evento', 
        'estado',
        'categoria',
        'fecha_inicio',
        'fecha_fin',
        'direccion_banner',
    ];
}