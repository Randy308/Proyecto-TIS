<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    use HasFactory;
    protected $fillable = [
        'eventable_id', 'eventable_type', 'nombre', 'fecha_hora_inicio', 'fecha_hora_fin'
        
    ];

    public function eventable()
    {
        return $this->morphTo();
    }
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
