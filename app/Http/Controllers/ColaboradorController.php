<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{

    public function index()
    {
        //
        return view('mis-colaboradores');
    }
    public function asignarColaborador($user, $colaborador)
    {
        //
        $todayDate = now('GMT-4')->format('Y-m-d');
        $miColaborador = User::FindOrFail($colaborador);
        $eventos = Evento::where('user_id', '=', $user)->where('fecha_inicio', '>=', $todayDate)->get();

        return view('misEventosDisponibles', compact('miColaborador', 'eventos'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request, $user, $colaborador)
    {
        //
        //return $request;
        $inputArray = $request->input('eventos');


        if ($request->filled('eventos') && is_array($inputArray)) {
            foreach ($inputArray as $value) {
                $miEvento = Evento::where('id', $value)->where('user_id', $user)->first();

                if ($miEvento) {
                    $usuarioExistente = $miEvento->colaboradors()->where('user_id', $colaborador)->exists();

                    if (!$usuarioExistente) {
                        $miColaborador = new Colaborador();
                        $miColaborador->evento_id = $miEvento->id;
                        $miColaborador->user_id = $colaborador;
                        $miColaborador->rol = "Colaborador";
                        $miColaborador->save();
                    }

                }
            }
        } else {
        }
        //return view('mis-colaboradores');
        return redirect()->route('colaboradores.index')->with('status', 'Se ha agregado un colaborador al evento exitosamente!');
    }


    public function show(Colaborador $colaborador)
    {
        //
    }


    public function edit(Colaborador $colaborador)
    {
        //
    }


    public function update(Request $request, Colaborador $colaborador)
    {
        //
    }


    public function destroy(Colaborador $colaborador)
    {
        //
    }
}
