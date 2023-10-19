<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
class ParticipanteController extends Controller
{

    public function index()
    {
        return view('registrarParticipante');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {   $this->validate($request, [
        'name' => 'required|string',
        'telefono' => 'required',
        'direccion' => 'required|string',
        'email' => 'required',
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'fecha_nac' => 'required',
        'carrera' => 'required',
        'foto_perfil' => 'required|image|max:2048',

    ]);
        return $request;
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
