<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\AsistenciaEvento;
use Carbon\Carbon;

class NotificacionesControlador extends Controller
{
    //'asistencia_id',
    /*'asunto',
    'detalle',
    'fechaHora',
    'visto',
*/
    public function notificarParticipantes($evento_id,Request $request){
        $asistentes = AsistenciaEvento::where('evento_id', $evento_id)->get();
        foreach($asistentes as $asistente){
            $not = new Notificacion();//trim($request->input('nombre_evento'))
            $not->asistencia_id = $asistente->id;
            $not->asunto = trim($request->input('asunto'));
            $not->detalle = trim($request->input('detalle'));
            $not->fechaHora = Carbon::now();
            $not->visto = false;
            $not->save();
        }
        return redirect()->back()->with('status', 'Notificacion eviada exitosamente');
    }
}
