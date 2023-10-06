<?php
namespace App\Http\Controllers;

use App\Models\AsistenciaEvento;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class EventoControlador extends Controller
{



    public function update($id, Request $request)
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
    public function listaEventos()
    {
        return view('lista-eventos');
    }
    public function getAllEventos()
    {
        $eventos = Evento::all();

        return $eventos;
    }
    public function show($id)
    {
        return view('plantilla-uno', [
            'evento' => Evento::findOrFail($id)
        ]);
    }
    public function crearEventoForm()
    {
        return view('crear-evento');
    }

    public function crearEvento(Request $request)
    {
        $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion_evento' => 'required|string',
            'estado' => 'required|in:activo,finalizado,cancelado',
            // Validación con valores permitidos
            'categoria' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'direccion_banner' => 'image|max:2048',
        ]);
        try {

            if (empty($request['direccion_banner'])) {
                $imagen = 'imagenes/m0zg7XFKo7fQMgsjbvbYl8b71IqAZzn06bbJyo1e.png';
            } else {
                $imagen = $request->file('direccion_banner')->store('public/imagenes');
            }

            $url = Storage::url($imagen);
            // Crear una nueva instancia de Evento con los datos del formulario
            $evento = new Evento();
            $evento->idUsuario = 1;
            $evento->nombre_evento = $request['nombre_evento'];
            $evento->descripcion_evento = $request['descripcion_evento'];
            $evento->estado = $request['estado'];
            $evento->categoria = $request['categoria'];
            $evento->fecha_inicio = $request['fecha_inicio'];
            $evento->fecha_fin = $request['fecha_fin'];
            $evento->direccion_banner = $url;

            $evento->save();

            return redirect()->route('index')->with('status', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');
        } catch (\Exception $e) {
            return redirect()->route('index')->withErrors(['error' => '¡Error no se guardo los datos  ' . $e]);

        }
    }
}
