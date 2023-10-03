<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoControlador extends Controller
{


    

    public function listaEventos()
    {
        return view('lista-eventos');
    }
    public function getAllEventos(){
        $eventos = Evento::all();

        return $eventos;
    }

    public function crearEventoForm()
    {
        return view('crear-evento');
    }

    public function show($id)
    {   return view('plantilla-uno', [
            'evento' => Evento::findOrFail($id)
        ]);
    }


    public function crearEvento(Request $request)
    {
        try {
            $request->validate([

                'nombre_evento' => 'required|string|max:255',
                'descripcion_evento' => 'required|string',
                'estado' => 'required|in:activo,finalizado,cancelado', // Validación con valores permitidos
                'categoria' => 'required|string',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after:fecha_inicio',

            ]);

            // Crear una nueva instancia de Evento con los datos del formulario
            $evento = new Evento([
                'nombre_evento' => $request->input('nombre_evento'),
                'descripcion_evento' => $request->input('descripcion_evento'),
                'estado' => $request->input('estado'),
                'categoria' => $request->input('categoria'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_fin' => $request->input('fecha_fin'),
                'direccion_banner' => $request->input('direccion_banner'), // Añadir aquí si es necesario
            ]);

            $evento->save();


            //return redirect('/crear-evento')->with('success', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');
            //return redirect()->route('crearEventoForm')->with('status', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');

            return redirect('/#')->with('success', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');

        } catch (\Exception $e) {
            return redirect('/crear-evento')->with('failed', '¡Error no se guardo los datos');
        }
    }

}