<?php

namespace App\Http\Controllers;

use App\Models\CoordenadaEvento;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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
        try {

            $rutaBanner = $this->generarBanner(
                $request->input('nombre_evento'),
                $request->input('fecha_inicio'),
                $request->input('fecha_fin')
            );
            $nombreDelArchivo = basename($rutaBanner);
            $evento = new Evento([
                'nombre_evento' => $request->input('nombre_evento'),
                'descripcion_evento' => $request->input('descripcion_evento'),
                'user_id' => auth()->id(),
                'estado' => 'Borrador',
                'categoria' => $request->input('categoria'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_fin' => $request->input('fecha_fin'),
                'direccion_banner' => '/storage/banners/' . $nombreDelArchivo,

            ]);

            $evento->save();

            return redirect()->route('index')->with('status', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');
        } catch (ValidationException $e) {
            return redirect()->route('index')->withErrors(['error' => '¡Error no se guardo los datos  ' . $e]);
        }
    }

    public function edit($id)
    {
        //
        return $id;
    }
    public function editBanner($id)
    {
        //
        return view('editar-evento', ['evento' => Evento::findOrFail($id)]);
        
    }


    public function destroy($id)
    {
        //
        return $id;
    }
}
