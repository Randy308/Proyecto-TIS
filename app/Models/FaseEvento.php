<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Evento;
class FaseEvento extends Model
{
    use HasFactory;


    protected $fillable = [
        'evento_id',
        'nombre_fase',
        'descripcion_fase',
        'fechaInicio',
        'fechaFin',
        'tipo',
        'actual',  
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
