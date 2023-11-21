<?php

namespace App\Http\Controllers;

use App\Models\CoordenadaEvento;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\AsistenciaEvento;
use Illuminate\Support\Facades\DB;

class EventoControlador extends Controller
{
    public function generarBanner($nombreEvento, $fechaInicio, $fechaFin, $background_color)
    {
        $textoBanner = "Evento: $nombreEvento\nFecha de inicio: $fechaInicio\nFecha de finalización: $fechaFin";


        $banner = Image::canvas(800, 200, $background_color);

        $banner->text($textoBanner, 400, 100, function ($font) {
            $font->file(public_path('fonts/InterTight-Black.ttf'));
            $font->size(24);
            $font->color('#fff');
            $font->align('center');
        });

        $folderPath = public_path('storage/banners');

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $nombreArchivo = "banner_" . $nombreEvento . ".png";
        $rutaBanner = public_path('storage/banners/' . $nombreArchivo);
        $banner->save($rutaBanner);
        return $rutaBanner;
    }

    public function show($id)
    {
        return view('visualizar-evento', [
            'evento' => Evento::findOrFail($id)
        ]);
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

    public function crearEventoForm()
    {
        return view('crear-evento');
    }


    public function crearEvento(Request $request)
    {
        $nombreEvento = preg_replace('/\s+/', ' ', trim($request->input('nombre_evento')));
        $descripcionEvento = preg_replace('/\s+/', ' ', trim($request->input('descripcion_evento')));
    
        $validator = $request->validate([
            'nombre_evento' => [
                'required',
                'string',
                'max:255',
                Rule::unique('eventos', 'nombre_evento')->ignore($request->input('id'), 'id'),
            ],
            'descripcion_evento' => 'required|string',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ], [
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a la fecha actual.',
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'nombre_evento.unique' => 'El nombre del evento ya ha sido tomado. Por favor, elige un nombre único.'
        ]);
    
        $background_color = '#21618C';
        $rutaBanner = $this->generarBanner(
            $nombreEvento,
            $request->input('fecha_inicio'),
            $request->input('fecha_fin'),
            $background_color,
        );
    
        $nombreDelArchivo = basename($rutaBanner);
    
        $evento = new Evento([
            'nombre_evento' => $nombreEvento,
            'descripcion_evento' => $descripcionEvento,
            'user_id' => auth()->id(),
            'estado' => 'Borrador',
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin'),
            'direccion_banner' => '/storage/banners/' . $nombreDelArchivo,
            'background_color' => '#21618C',
            'privacidad' => $request->input('privacidad'),
            'inscritos_minimos' => $request->input('inscritos_minimos'),
            'inscritos_maximos' => $request->input('inscritos_maximos'),
            'tipo_evento' => $request->input('tipo_evento'),
        ]);
    
        $evento->save();
    
        return redirect()->route('index')->with('status', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');
    }
    public function edit($user, $evento)
    {
        $tiposEvento = ['reclutamiento', 'competencia_individual', 'competencia_grupal', 'taller_individual', 'taller_grupal'];
        $privacidades = ['publico', 'institucional'];
    
        $miEvento = Evento::where('user_id', '=', $user)->where('id', '=', $evento)->first();
    
        return view('actualizar-evento', compact('miEvento', 'tiposEvento', 'privacidades'));
    }
    
    public function updateEstado($user, $evento, Request $request)
    {
        //
        $evento = Evento::where('user_id', '=', $user)->where('id', '=', $evento)->first();
        $evento->estado = 'Activo';
        $evento->save();
        return redirect()->route('listaEventos')->with('status', '¡Se ha publicado el Evento exitosamente!.');

    }
    public function editBanner($user, $evento)
    {
        //
        return view('editar-evento', ['evento' => Evento::findOrFail($evento)]);

    }
    public function update($user, $evento, Request $request)
    {
        $request->validate([
            'nombre_evento' => [
                'required',
                'string',
                'max:255',
                Rule::unique('eventos', 'nombre_evento')->where(function ($query) use ($request) {
                    return $query->where('tipo_evento', $request->input('tipo_evento'));
                })->ignore($evento, 'id'),
            ],
            'descripcion_evento' => 'required|string',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'inscritos_minimos' => 'nullable|integer|min:0',
            'inscritos_maximos' => 'nullable|integer|gte:inscritos_minimos',
        ], [
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a la fecha actual.',
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'nombre_evento.unique' => 'El nombre del evento ya ha sido tomado en esta categoría. Por favor, elige un nombre único.',
            'inscritos_maximos.gte' => 'El número máximo de inscritos debe ser igual o mayor al número mínimo de inscritos.',
        ]);
    
        $evento = Evento::where('user_id', $user)->where('id', $evento)->first();
    
        // Actualizar los campos del modelo con los nuevos nombres
        $evento->nombre_evento = $request->input('nombre_evento');
        $evento->descripcion_evento = $request->input('descripcion_evento');
        $evento->tipo_evento = $request->input('tipo_evento');
        $evento->fecha_inicio = $request->input('fecha_inicio');
        $evento->fecha_fin = $request->input('fecha_fin');
        $evento->privacidad_evento = $request->input('privacidad');
        $evento->min_inscritos = $request->input('inscritos_minimos');
        $evento->max_inscritos = $request->input('inscritos_maximos');
    
        $evento->save();
    
        session()->flash('status', 'Los datos del evento se han actualizado con éxito.');
        return redirect()->route('misEventos');
    }
    
    
    public function updateBanner($user, $evento, Request $request)
    {
        $request->validate([
            'imagen-banner' => 'required|string',
        ]);
        $eventoActual = Evento::FindOrFail($evento);

        $png_url = "banner-" . time() . ".png";
        $path = public_path() . '/storage/banners/' . $png_url;

        Image::make(file_get_contents($request->input('imagen-banner')))->save($path);

        $eventoActual->direccion_banner = '/storage/banners/' . $png_url;
        $eventoActual->update();
        return redirect()->route('misEventos')->with('status', '¡Banner actualizado exitosamente!.');

    }

    public function destroy($user, $evento)
    {
        //
        return $evento;
    }
}
