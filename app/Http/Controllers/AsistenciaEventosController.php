<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsistenciaEventosController extends Controller
{
    //
    function destroy($user ,$evento){
        $asistencia = AsistenciaEvento::where('user_id', $user)->where('evento_id', $evento)->first();
        if ($asistencia) {
            $asistencia->delete();
            return redirect()->back()->with('status', '¡Se ha abandonado el evento exitosamente.');
          }else{

            return redirect()->back()->with('error', 'El usuario no esta registrado en el evento.');
          }
        
    }

    public function create($id, Request $request)
    {
        $evento_id = $request['evento'];
        $registroExistente = AsistenciaEvento::where('user_id', $id)
            ->where('evento_id', $evento_id)
            ->exists();

        if ($registroExistente) {
            return redirect()->route('index')->with('error', 'Ya estás registrado en este evento.');
        } else {
            $asistencia = new AsistenciaEvento();
            $asistencia->evento_id = $evento_id;
            $asistencia->user_id = $id;
            $asistencia->rol = 'participante';
            $asistencia->estado = 'participante';
            $asistencia->fechaInscripcion = now();
            $asistencia->save();
            return redirect()->back()->with('status', '¡Se ha añadido exitosamente.');

        }

    }
}
