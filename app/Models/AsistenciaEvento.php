<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaEvento extends Model
{
    use HasFactory;

    protected $fillable = [
        'evento_id',
        'user_id',
        'rol',
        'fechaInscripcion',
        'estado'
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class,'evento_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    
}
