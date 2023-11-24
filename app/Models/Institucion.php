<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_institucion'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
