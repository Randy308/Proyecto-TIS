<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertenecenGrupo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'grupo_id',
        'evento_id',
    ];

    public function eventos()
    {
        return $this->belongsTo(Evento::class);
    }
}
