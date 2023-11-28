<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    use HasFactory;

    protected $fillable = [
        'evento_id',
        'nombre',
        'descripcion',
        'fechaIni',
        'fechaFin',
    ];
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
