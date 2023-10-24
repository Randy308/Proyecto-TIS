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
use App\Models\AsistenciaEvento;


class EventoControlador extends Controller
{
    public function generarBanner($nombreEvento, $fechaInicio, $fechaFin)
    {
        $textoBanner = "Evento: $nombreEvento\nFecha de inicio: $fechaInicio\nFecha de finalización: $fechaFin";


        $banner = Image::canvas(800, 200, '#3498db');

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
                Rule::unique('eventos', 'nombre_evento')->where(function ($query) use ($request) {
                    return $query->where('categoria', $request->input('categoria'));
                })->ignore($request->input('id'), 'id'), 
            ],
            'descripcion_evento' => 'required|string',
            'categoria' => 'required|string|in:Diseño,QA,Desarrollo,Ciencia de datos',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ], [
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a la fecha actual.',
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'nombre_evento.unique' => 'El nombre del evento ya ha sido tomado en esta categoría. Por favor, elige un nombre único.'
        ]);

        $rutaBanner = $this->generarBanner(
            $request->input('$nombreEvento'),
            $request->input('fecha_inicio'),
            $request->input('fecha_fin')
        );
        $nombreDelArchivo = basename($rutaBanner);
        
        $evento = new Evento([
            'nombre_evento' => $nombreEvento,
            'descripcion_evento' => $descripcionEvento,
            'user_id' => auth()->id(),
            'estado' => 'Borrador',
            'categoria' => $request->input('categoria'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin'),
            'direccion_banner' => '/storage/banners/' . $nombreDelArchivo,
        ]);

        $evento->save();

        return redirect()->route('index')->with('status', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');
    }

    
    
}
