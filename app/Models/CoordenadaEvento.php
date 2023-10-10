<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoordenadaEvento extends Model
{
    use HasFactory;

    protected $table = 'CoordenadaEvento'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Nombre de la clave primaria

    // Campos que pueden llenarse masivamente (de acuerdo a tu migración)
    protected $fillable = [
        'idEvento',
        'nombreEx',
        'nombreEy',
        'descripcionEx',
        'descripcionEy',
        'fechaIX',
        'fechaIY',
        'fechaFX',
        'fechaFY',
        'mostrarOrganizaciones',
        'mostrarPatrocinadores',
    ];

    // Definir la relación con la tabla "eventos"
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'idEvento', 'idEvento');
    }
}
