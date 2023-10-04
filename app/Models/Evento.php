<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    protected $primaryKey = 'idEvento';
    protected $fillable = [
        'nombre_evento',
        'descripcion_evento',
        // Agrega la columna DireccionImg al arreglo fillable
        'estado',
        'categoria',
        'fecha_inicio',
        'fecha_fin',
        'direccion_banner'
    ];

    public function usuarioPropietario()
    {
        return $this->belongsTo(User::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'asistencia_eventos');
    }
}
