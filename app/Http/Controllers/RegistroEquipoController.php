<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroEquipoController extends Controller
{
    //
    public function view($evento_id)
    {
        $evento = Evento::find($evento_id);
        $grupoExists = Grupo::where('user_id', Auth::user()->id)->where('evento_id', $evento_id)->exists();
        if ($grupoExists) {
            return redirect()->back()->with('warning', 'Ya pertenece a un grupo');
        }


        if ($evento->privacidad == 'libre') {

            return view('registrar-grupo', ['evento' => $evento]);
        } else {

            if ($evento->cantidad_maxima) {
                if ($evento->grupos()->where('estado', 'Habilitado')->count() < $evento->cantidad_maxima) {
                    return view('registrar-grupo', ['evento' => $evento]);
                } else {
                    return redirect()->back()->with('error', '¡No se pudo vincular al evento, no hay más cupos disponibles.');
                }
            } else {
                return view('registrar-grupo', ['evento' => $evento]);
            }
        }

    }
}
