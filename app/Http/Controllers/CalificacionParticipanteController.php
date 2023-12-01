<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaEvento;
use App\Models\CalificacionParticipante;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalificacionParticipanteController extends Controller
{

    public function index()
    {   //$users = User::paginate(20);
        $evento = Evento::find(1);

        // Verifica si el evento existe
        if ($evento) {
            // Obtén los usuarios que participan en este evento
            $users = $evento->users()->get();
        }
        //$users = User::where('estado', 'Habilitado')->get();
        return view('calificar-participantes', compact('users'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function list($evento_id)
    {



        return view('lista-participantes', compact('evento_id'));
    }
    public function show($evento_id)
    {

        $evento = Evento::find($evento_id);

        if ($evento) {
            $eventoId = $evento->id;

            $combinedData = DB::table('asistencia_eventos')
                ->join('users', 'asistencia_eventos.user_id', '=', 'users.id')
                ->where('asistencia_eventos.evento_id', $eventoId)
                ->select(
                    'asistencia_eventos.id as asistencia_id',
                    'users.id as user_id',
                    'users.email',
                    'users.name',
                    'asistencia_eventos.estado',
                    'asistencia_eventos.rol'
                    // Agrega más campos según sea necesario
                )
                ->get();

            // Ahora, $combinedData contendrá la información combinada de asistencias y usuarios
        }

        return view('calificar-participantes', compact('combinedData'));
    }


    public function edit(CalificacionParticipante $calificacionParticipante)
    {
        //
    }

    public function updateEstado(Request $request)
    {
        if ($request->ajax()) {
            AsistenciaEvento::find($request->asistencia_id)
                ->update([
                    $request->name => $request->action
                ]);

            return response()->json(['success' => true]);
        }
    }

    public function habilitarEstado($evento_id,$asistencia_id)
    {
        AsistenciaEvento::find($asistencia_id)
            ->update([
                'estado' => "Habilitado"
            ]);
        return redirect()->route('ver.participantes', compact('evento_id'))->with('status', 'Estado de la participacion actualizada.');
    }
    public function rechazarEstado($evento_id,$asistencia_id)
    {
        AsistenciaEvento::find($asistencia_id)
            ->update([
                'estado' => "Denegado"
            ]);
        return redirect()->route('ver.participantes', compact('evento_id'))->with('status', 'Estado de la participacion actualizada');
    }
    public function update(Request $request, CalificacionParticipante $calificacionParticipante)
    {
        if ($request->ajax()) {
            User::find($request->pk)
                ->update([
                    $request->name => $request->value
                ]);

            return response()->json(['success' => true]);
        }
    }


    public function destroy(CalificacionParticipante $calificacionParticipante)
    {
        //
    }
}
