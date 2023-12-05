<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'asistencia_id',
        'asunto',
        'detalle',
        'fechaHora',
        'visto',
    ];

    public function asistenciaEvento()
    {
        return $this->belongsTo(AsistenciaEvento::class);
    }
}
