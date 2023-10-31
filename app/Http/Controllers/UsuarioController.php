<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function listaUsuarios()
    {
        return view('lista-usuarios');
    }

    public function show($id)
    {
        return view('visualizar-usuario', [
            'usuario' => User::findOrFail($id)
        ]);
    }

    public function createForm()
    {
        return view('crear-usuario');
    }
}
