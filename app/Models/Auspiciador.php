<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auspiciador extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'url',
    ];


    public function eventosAuspicia()
    {
        return $this->belongsToMany(Evento::class, 'auspiciador_eventos');
    }
}
