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
}
