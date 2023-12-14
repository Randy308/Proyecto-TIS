<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaEvento;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AsistenciaEventosController extends Controller
{
    //
    function destroy($user, $evento)
    {
        $asistencia = AsistenciaEvento::where('user_id', $user)->where('evento_id', $evento)->first();
        if ($asistencia) {
            $asistencia->delete();
            return redirect()->back()->with('status', '¡Se ha abandonado el evento exitosamente.');
        } else {

            return redirect()->back()->with('error', 'El usuario no esta registrado en el evento.');
        }
    }
    public function create($id, Request $request)
    {
        $evento_id = $request['evento'];
        $evento = Evento::find($evento_id);
        $registroExistente = AsistenciaEvento::where('user_id', $id)
            ->where('evento_id', $evento_id)
            ->exists();

        if ($registroExistente) {
            return redirect()->route('index')->with('error', 'Ya estás registrado en este evento.');
        } else {

            if ($evento->privacidad == 'libre') {
                $asistencia = new AsistenciaEvento();
                $asistencia->evento_id = $evento_id;
                $asistencia->user_id = $id;
                $asistencia->rol = 'participante';
                $asistencia->estado = 'Habilitado';
                $asistencia->fechaInscripcion = now();
                $asistencia->save();
                return redirect()->back()->with('status', '¡Se ha añadido exitosamente.');
            } else {
                // Verificar cantidad máxima de participantes
                $bandera1 = false;
                if ($evento->cantidad_maxima) {
                    if ($evento->users()->where('asistencia_eventos.estado', 'Habilitado')->count() < $evento->cantidad_maxima) {
                        $bandera1 = true;
                    } else {
                        return redirect()->back()->with('error', '¡No se pudo vincular al evento, no hay más cupos disponibles.');
                    }
                } else {
                    $bandera1 = true;
                }

                // Verificar institución requerida
                $bandera2 = false;
                if ($evento->nombre_institucion) {
                    $user = User::find($id);
                    if ($user->institucion->nombre_institucion == $evento->nombre_institucion) {

                        if ($user->cod_estudiante) {
                            $bandera2 = true;
                        } else {
                            return redirect()->back()->with('error', '¡No se pudo vincular al evento, no tiene su codigo sis vinculado, actualize sus datos en el apartado editar perfil.');
                        }
                    } else {
                        return redirect()->back()->with('error', '¡No se pudo vincular al evento, no pertenece a la institución requerida.');
                    }
                } else {
                    $bandera2 = true;
                }

                // Verificar ambas banderas antes de proceder con la inscripción
                if ($bandera1 && $bandera2) {
                    $asistencia = new AsistenciaEvento();
                    $asistencia->evento_id = $evento_id;
                    $asistencia->user_id = $id;
                    $asistencia->rol = 'participante';
                    $asistencia->estado = 'Pendiente';
                    $asistencia->fechaInscripcion = now();
                    $asistencia->save();

                    return redirect()->back()->with('status', '¡Se ha añadido exitosamente.');
                }
            }
        }
    }
    public function eliminarParticipante(Request $request, $user, $evento)
    {
        if ($request->user() && ($request->user()->hasRole('administrador') || $request->user()->hasRole('colaborador'))) {
            $asistencia = AsistenciaEvento::where('user_id', $user)
                ->where('evento_id', $evento)
                ->first();

            if ($asistencia) {
                $mensaje = 'Participante eliminado por conducta indebida.';
                $asistencia->delete();
                return redirect()->back()->with('status', $mensaje);
            } else {
                return redirect()->back()->with('error', 'El usuario no está registrado en el evento.');
            }
        } else {
            return redirect()->back()->with('error', 'No tienes permisos para eliminar participantes por conducta indebida.');
        }
    }

    public function incluirGrupos($evento_id)
    {
        $evento = Evento::find($evento_id);
        $grupos = $evento->grupos;
        foreach ($grupos as $grupo) {
            if ($grupo->estado != 'Habilitado') {
                $grupo->estado = 'Habilitado';
                $grupo->save();
            }
        }
        //return $participantes;
        return redirect()->back()->with('status', 'Se han habilitado a todos los grupos del evento.');
    }

    public function incluirParticipantes($evento_id)
    {
        $evento = Evento::find($evento_id);
        $participantes = $evento->users;
        foreach ($participantes as $participante) {
            $asistencia = AsistenciaEvento::where('evento_id', $evento_id)->where('user_id', $participante->id)->first();
            if ($asistencia->estado != 'Habilitado') {
                $asistencia->estado = 'Habilitado';
                $asistencia->save();
            }
        }
        //return $participantes;
        return redirect()->back()->with('status', 'Se han habilitado a todos los participantes al evento.');
    }
}
