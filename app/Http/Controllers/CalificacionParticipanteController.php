<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaEvento;
use App\Models\Calificacion;
use App\Models\CalificacionEvento;
use App\Models\CalificacionGrupo;
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
        $evento = Evento::find($evento_id);
        $anterior = $evento->calificacions()->where('calificacion_eventos.evento_id', $evento_id)->first();
        $existePromedio = CalificacionEvento::where('es_promedio', true)
            ->where('evento_id', $evento_id)->exists();
        if ($existePromedio) {
            $existe = 1;
        } else {
            $existe = 0;
        }
        return view('lista-de-calificaciones', compact('evento_id', 'anterior', 'existe'));
    }

    public function indexCalificacionesGrupo($evento_id)
    {   //$users = User::paginate(20);
        $evento = Evento::find($evento_id);
        $anterior = $evento->calificacions()->where('calificacion_eventos.evento_id', $evento_id)->first();
        $existePromedio = CalificacionEvento::where('es_promedio', true)
            ->where('evento_id', $evento_id)->exists();
        if ($existePromedio) {
            $existe = 1;
        } else {
            $existe = 0;
        }
        return view('lista-de-calificaciones', compact('evento_id', 'anterior', 'existe'));
    }


    public function createGrupal(Request $request, $evento_id)
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

        $grupos = $evento->grupos()->where('estado', 'Habilitado')->get();
        foreach ($grupos as $grupo) {
            $calificacion_user = new CalificacionGrupo([
                'calificacion_id' => $calificacion->id,
                'grupo_id' => $grupo->id,
                'evento_id' => $evento->id,
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

    public function createPromedioGrupos(Request $request, $evento_id)
    {
        $evento = Evento::find($evento_id);

        $existeCalificacionConPromedio = CalificacionEvento::where('es_promedio', true)
            ->where('evento_id', $evento_id)->exists();
        if ($existeCalificacionConPromedio) {

            return redirect()->back()->with('warning', 'Ya se ha asignado una calificacion final al evento');
        }
        $anteriores = $evento->calificacions()->where('calificacion_eventos.evento_id', $evento_id)->get();
        if (!$anteriores) {

            return redirect()->back()->with('warning', 'No se pudo realizar la accion porque no existen calificaciones asociadas a este evento');
        }
        if ($anteriores->count() == 1) {
            foreach ($anteriores as $anterior) {
                $miCalificacion = CalificacionEvento::where('calificacion_id', $anterior->id)
                    ->where('evento_id', $evento_id)->first();
                $miCalificacion->es_promedio = true;
                $miCalificacion->save();
                return redirect()->back()->with('success', 'Promedio creado con éxito');
            }
        }
        $anterior = $evento->calificacions()->where('calificacion_eventos.evento_id', $evento_id)->first();
        $calificacion = new Calificacion([
            'nombre' => "Resultado Final",
            'nota_minima_aprobacion' => $anterior->nota_minima_aprobacion,
            'nota_maxima' => $anterior->nota_maxima,
        ]);


        $calificacion->save();


        $calificacion_evento = new CalificacionEvento([
            'evento_id' => $evento_id,
            'calificacion_id' => $calificacion->id,
            'es_promedio' => true,
        ]);


        $calificaciones = $evento->calificacions;
        if ($calificaciones) {
            $calificacion_evento->orden_secuencia = $calificaciones->count() + 1;
        } else {
            $calificacion_evento->orden_secuencia = 1;
        }

        $calificacion_evento->save();

        $grupos = $evento->grupos()->where('estado', 'Habilitado')->get();
        //$promedios = [];

        foreach ($grupos as $grupo) {
            $promedio = CalificacionGrupo::where('grupo_id', $grupo->id)->where('evento_id', $evento->id)->avg('puntaje');

            $calificacion_user = new CalificacionGrupo([
                'calificacion_id' => $calificacion->id,
                'grupo_id' => $grupo->id,
                'evento_id' => $evento->id,
                'puntaje' => $promedio,
            ]);
            $calificacion_user->save();

            //$promedios[$usuario->id] = $promedio;
        }

        //return response()->json(['promedios' => $promedios]);

        // if ($request->has('mi_checkbox')) {

        //     $calificacion_evento->es_promedio = true;
        //     return "El checkbox ha sido marcado";
        // }
        return redirect()->back()->with('success', 'Promedio creado con éxito');
    }

    public function createPromedio(Request $request, $evento_id)
    {
        $evento = Evento::find($evento_id);

        $existeCalificacionConPromedio = CalificacionEvento::where('es_promedio', true)
            ->where('evento_id', $evento_id)->exists();
        if ($existeCalificacionConPromedio) {

            return redirect()->back()->with('warning', 'Ya se ha asignado una calificacion final al evento');
        }
        $anteriores = $evento->calificacions()->where('calificacion_eventos.evento_id', $evento_id)->get();
        if (!$anteriores) {

            return redirect()->back()->with('warning', 'No se pudo realizar la accion porque no existen calificaciones asociadas a este evento');
        }
        if ($anteriores->count() == 1) {
            foreach ($anteriores as $anterior) {
                $miCalificacion = CalificacionEvento::where('calificacion_id', $anterior->id)
                    ->where('evento_id', $evento_id)->first();
                $miCalificacion->es_promedio = true;
                $miCalificacion->save();
                return redirect()->back()->with('success', 'Promedio creado con éxito');
            }
        }
        $anterior = $evento->calificacions()->where('calificacion_eventos.evento_id', $evento_id)->first();
        $calificacion = new Calificacion([
            'nombre' => "Resultado Final",
            'nota_minima_aprobacion' => $anterior->nota_minima_aprobacion,
            'nota_maxima' => $anterior->nota_maxima,
        ]);


        $calificacion->save();


        $calificacion_evento = new CalificacionEvento([
            'evento_id' => $evento_id,
            'calificacion_id' => $calificacion->id,
            'es_promedio' => true,
        ]);


        $calificaciones = $evento->calificacions;
        if ($calificaciones) {
            $calificacion_evento->orden_secuencia = $calificaciones->count() + 1;
        } else {
            $calificacion_evento->orden_secuencia = 1;
        }

        $calificacion_evento->save();

        $usuarios = $evento->users()->where('asistencia_eventos.estado', 'Habilitado')->get();
        //$promedios = [];

        foreach ($usuarios as $usuario) {
            $promedio = CalificacionUsuario::where('user_id', $usuario->id)->where('evento_id', $evento->id)->avg('puntaje');

            $calificacion_user = new CalificacionUsuario([
                'calificacion_id' => $calificacion->id,
                'user_id' => $usuario->id,
                'evento_id' => $evento->id,
                'puntaje' => $promedio,
            ]);
            $calificacion_user->save();

            //$promedios[$usuario->id] = $promedio;
        }

        //return response()->json(['promedios' => $promedios]);

        // if ($request->has('mi_checkbox')) {

        //     $calificacion_evento->es_promedio = true;
        //     return "El checkbox ha sido marcado";
        // }
        return redirect()->back()->with('success', 'Promedio creado con éxito');
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
        $existeCalificacionConPromedio = CalificacionEvento::where('es_promedio', true)
            ->where('evento_id', $evento_id)->exists();
        if ($existeCalificacionConPromedio) {

            return redirect()->back()->with('warning', 'Ya existe una calificacion final al evento,no se permiten crear mas calificaciones');
        }

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
                'evento_id' => $evento->id,
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

    public function showGrupos($evento_id, $calificacion_id)
    {

        $evento = Evento::find($evento_id);

        if ($evento) {
            $eventoId = $evento->id;

            $calificacion = Calificacion::where('id', $calificacion_id)->first();
            $combinedData = DB::table('calificacion_grupos')
                ->join('calificacions', 'calificacion_grupos.calificacion_id', '=', 'calificacions.id')
                ->join('grupos', 'calificacion_grupos.grupo_id', '=', 'grupos.id')
                ->join('users', 'grupos.user_id', '=', 'users.id')
                ->where('calificacion_grupos.calificacion_id', $calificacion_id)
                ->select(
                    'calificacion_grupos.calificacion_id as calificacion_id',
                    'grupos.id as grupo_id',
                    'grupos.nombre',
                    'users.email',
                    'calificacions.nota_minima_aprobacion',
                    'calificacions.nota_maxima',
                    'calificacion_grupos.puntaje'
                )
                ->get();


            // Ahora, $combinedData contendrá la información combinada de asistencias y usuarios
        }

        return view('calificar-grupos-evento', compact('combinedData', 'calificacion', 'evento'));
    }

    public function show($evento_id, $calificacion_id)
    {

        $evento = Evento::find($evento_id);

        if ($evento) {
            $eventoId = $evento->id;

            $calificacion = Calificacion::where('id', $calificacion_id)->first();
            $combinedData = DB::table('calificacion_usuarios')
                ->join('calificacions', 'calificacion_usuarios.calificacion_id', '=', 'calificacions.id')
                ->join('users', 'calificacion_usuarios.user_id', '=', 'users.id')
                ->where('calificacion_usuarios.calificacion_id', $calificacion_id)
                ->select(
                    'calificacion_usuarios.calificacion_id as calificacion_id',
                    'users.id as user_id',
                    'users.email',
                    'users.name',
                    'calificacions.nota_minima_aprobacion',
                    'calificacions.nota_maxima',
                    'calificacion_usuarios.puntaje'
                )
                ->get();


            // Ahora, $combinedData contendrá la información combinada de asistencias y usuarios
        }

        return view('calificar-participantes', compact('combinedData', 'calificacion', 'evento'));
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

    public function update(Request $request)
    {
        $micalificacion = Calificacion::find($request->calificacion)->first();
        $this->validate($request, [

            'pk' => 'required|numeric',
            'calificacion' => 'required|numeric',
            'value' => 'required|numeric|min:0|max:' . $micalificacion->nota_maxima,

        ]);

        $user_id = $request->input('pk');
        $calificacion_id = $request->calificacion;
        // Resto del código...

        //if($micalificacion->nota_maxima < )
        //return response()->json(['success' => true, 'message' => 'Actualización exitosa', 'usuario' => $user_id,'calificacion' => $calificacion_id,]);
        //return response()->json(['success' => true, 'message' => $request->all()]);

        $calificacion = CalificacionUsuario::where('user_id', $user_id)
            ->where('calificacion_id', $calificacion_id)
            ->first();

        // Verificar si se encontró el registro
        if ($calificacion) {
            // Actualizar el campo específico
            $calificacion->update([
                $request->name => $request->value
            ]);

            // Puedes devolver una respuesta adecuada si es necesario
            return response()->json(['success' => true, 'message' => 'Se asigno el puntaje exitosamente', 'puntaje' => $request->input('value')]);
        } else {
            // Puedes devolver un error si no se encuentra el registro
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
    }

    public function updateGrupos(Request $request)
    {
        $micalificacion = Calificacion::find($request->calificacion)->first();
        $this->validate($request, [

            'pk' => 'required|numeric',
            'calificacion' => 'required|numeric',
            'value' => 'required|numeric|min:0|max:' . $micalificacion->nota_maxima,

        ]);

        $user_id = $request->input('pk');
        $calificacion_id = $request->calificacion;
        // Resto del código...

        //if($micalificacion->nota_maxima < )
        //return response()->json(['success' => true, 'message' => 'Actualización exitosa', 'usuario' => $user_id,'calificacion' => $calificacion_id,]);
        //return response()->json(['success' => true, 'message' => $request->all()]);

        $calificacion = CalificacionGrupo::where('grupo_id', $user_id)
            ->where('calificacion_id', $calificacion_id)
            ->first();

        // Verificar si se encontró el registro
        if ($calificacion) {
            // Actualizar el campo específico
            $calificacion->update([
                $request->name => $request->value
            ]);

            // Puedes devolver una respuesta adecuada si es necesario
            return response()->json(['success' => true, 'message' => 'Se asigno el puntaje exitosamente', 'puntaje' => $request->input('value')]);
        } else {
            // Puedes devolver un error si no se encuentra el registro
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
    }

    public function destroy($calificacion_id)
    {
        //
        $calificacion = Calificacion::where('id', $calificacion_id)->first();
        //return $calificacion;
        $calificacion->delete();
        return redirect()->back()->with('success', 'Calificación eliminada con éxito');
    }
}
