<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'user_id',
        'evento_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
    public function users_pertenecen_grupos()
    {
        return $this->belongsToMany(User::class, 'pertenecen_grupos');
    }
}
