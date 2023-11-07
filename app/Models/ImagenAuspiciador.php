<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Evento;

class ImagenAuspiciador extends Model
{
    //use HasFactory;
    protected $fillable = [
        'evento_id',
        'url'
    ];

    public function evento(){
        return $this->belongsTo(Evento::class);
    }
}

