<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function listaUsuarios()
    {
        return view('lista-usuarios');
    }
}
