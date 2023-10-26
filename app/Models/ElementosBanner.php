<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementosBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'evento_id',
        'text',
        'top',
        'left',
        'width',
        'height',
        'text_decoration',
        'font_style',
        'background',
        'color',
        'font_family',
        'font_size',
    ];
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
