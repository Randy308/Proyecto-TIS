<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuspiciadorEventos extends Model
{
    use HasFactory;
    protected $fillable = [
        'evento_id',
        'auspiciador_id',
    ];
}
