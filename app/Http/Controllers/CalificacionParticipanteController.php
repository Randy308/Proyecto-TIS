<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaEvento;
use App\Models\Calificacion;
use App\Models\CalificacionEvento;
use App\Models\CalificacionParticipante;
use App\Models\CalificacionUsuario;
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
    public function indexCalificaciones($evento_id)
    {   //$users = User::paginate(20);
        return view('lista-de-calificaciones', compact('evento_id'));
    }

    public function create(Request $request, $evento_id)
    {
        //
        $this->validate($request, [

            'nombre' => 'required|unique:calificacions,nombre|string|regex:/^[a-zA-Z\s]*$/',
            'nota_minima_aprobacion' => 'required|numeric',
            'nota_maxima' => 'required|numeric',

        ]);
        $evento = Evento::find($evento_id);


        $calificacion = new Calificacion([
            'nombre' => $request->input('nombre'),
            'nota_minima_aprobacion' => $request->input('nota_minima_aprobacion'),
            'nota_maxima' => $request->input('nota_maxima'),
        ]);


        $calificacion->save();


        $calificacion_evento = new CalificacionEvento([
            'evento_id' => $evento_id,
            'calificacion_id' => $calificacion->id,
            'es_promedio' => false,
        ]);


        $calificaciones = $evento->calificacions;
        if ($calificaciones) {
            $calificacion_evento->orden_secuencia = $calificaciones->count() + 1;
        } else {
            $calificacion_evento->orden_secuencia = 1;
        }

        $calificacion_evento->save();

        $usuarios = $evento->users()->where('asistencia_eventos.estado', 'Habilitado')->get();
        foreach ($usuarios as $user) {
            $calificacion_user = new CalificacionUsuario([
                'calificacion_id' => $calificacion->id,
                'user_id' => $user->id,
                'puntaje' => 0,
            ]);
            $calificacion_user->save();

        }

        // if ($request->has('mi_checkbox')) {

        //     $calificacion_evento->es_promedio = true;
        //     return "El checkbox ha sido marcado";
        // }
        return redirect()->back()->with('success', 'Calificación agregada con éxito');
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

            // $combinedData = DB::table('asistencia_eventos')
            //     ->join('users', 'asistencia_eventos.user_id', '=', 'users.id')
            //     ->where('asistencia_eventos.evento_id', $eventoId)
            //     ->select(
            //         'asistencia_eventos.id as asistencia_id',
            //         'users.id as user_id',
            //         'users.email',
            //         'users.name',
            //         'asistencia_eventos.estado',
            //         'asistencia_eventos.rol'
            //         // Agrega más campos según sea necesario
            //     )
            //     ->get();
            $combinedData = DB::table('calificacion_eventos')
                ->join('calificacions', 'calificacion_eventos.calificacion_id', '=', 'calificacions.id')
                ->join('calificacion_usuarios', 'calificacion_eventos.calificacion_id', '=', 'calificacion_usuarios.calificacion_id')
                ->join('users', 'calificacion_usuarios.user_id', '=', 'users.id')
                ->where('calificacion_eventos.evento_id', $eventoId)
                ->select(
                    'calificacion_usuarios.id as calificacion_id',
                    'users.email',
                    'users.name',
                    'calificacions.nota_minima_aprobacion',
                    'calificacions.nota_maxima',
                    'calificacion_usuarios.puntaje'
                )
                ->get();


            // Ahora, $combinedData contendrá la información combinada de asistencias y usuarios
        }

        return view('calificar-participantes', compact('combinedData'));
    }


    public function edit($calificacionParticipante)
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

    public function habilitarEstado($evento_id, $asistencia_id)
    {
        AsistenciaEvento::find($asistencia_id)
            ->update([
                'estado' => "Habilitado"
            ]);
        return redirect()->route('ver.participantes', compact('evento_id'))->with('status', 'Estado de la participacion actualizada.');
    }
    public function rechazarEstado($evento_id, $asistencia_id)
    {
        AsistenciaEvento::find($asistencia_id)
            ->update([
                'estado' => "Denegado"
            ]);
        return redirect()->route('ver.participantes', compact('evento_id'))->with('status', 'Estado de la participacion actualizada');
    }
    public function posponerEstado($evento_id, $asistencia_id)
    {
        AsistenciaEvento::find($asistencia_id)
            ->update([
                'estado' => "Pendiente"
            ]);
        return redirect()->route('ver.participantes', compact('evento_id'))->with('status', 'Estado de la participacion actualizada');
    }
    public function update(Request $request, $calificacionParticipante)
    {
        if ($request->ajax()) {
            User::find($request->pk)
                ->update([
                    $request->name => $request->value
                ]);

            return response()->json(['success' => true]);
        }
    }


    public function destroy($calificacionParticipante)
    {
        //
    }
}
