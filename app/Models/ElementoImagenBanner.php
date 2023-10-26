<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ElementoImagenBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'evento_id',
        'top',
        'left',
        'width',
        'height',
        'href',
    ];
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}

