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
use App\Models\Auspiciador;
use App\Models\AuspiciadorEventos;
use App\Models\ImagenAuspiciador;



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

    public function show($id) //id de evento
    {
        $evento = Evento::find($id);
        $imgAuspiciadores = ImagenAuspiciador::where('evento_id', $id)->get();

        return view('visualizar-evento', compact('evento', 'imgAuspiciadores'));
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
            "Auspiciadores"    => "array",
            "Auspiciadores.*"  => "string|distinct",
        ], [
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a la fecha actual.',
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'nombre_evento.unique' => 'El nombre del evento ya ha sido tomado en esta categoría. Por favor, elige un nombre único.'
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
            'categoria' => $request->input('categoria'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin'),
            'direccion_banner' => '/storage/banners/' . $nombreDelArchivo,

            'latitud' => -17.39359989348116,
            'longitud' => -66.14596353915297,

            'background_color' => '#21618C'

        ]);

        $evento->save();
        $inputArray = $request->input('Auspiciadores');

        if ($request->filled('Auspiciadores') && is_array($inputArray)) {
            foreach ($inputArray as $value) {
                $miAuspiciador = Auspiciador::where('nombre', $value)->first();

                if ($miAuspiciador) {
                    $auspiciadorEvento = new AuspiciadorEventos();
                    $auspiciadorEvento->evento_id = $evento->id;
                    $auspiciadorEvento->auspiciador_id = $miAuspiciador->id;
                    $auspiciadorEvento->save();
                } else {
                }
            }
        } else {
        }

        return redirect()->route('index')->with('status', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');
    }
    public function index()
    {
        $auspiciadores = Auspiciador::get();
        return view('crear-evento', compact('auspiciadores'));
    }
    public function edit($user, $evento)
    {
        //
        $categorias = ['Diseño', 'QA', 'Desarrollo', 'Ciencia de datos'];
        $miEvento = Evento::where('user_id', '=', $user)->where('id', '=', $evento)->first();
        return view('actualizar-evento', compact('miEvento', 'categorias'));
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
        //
        $request->validate([
            'nombre_evento' => [
                'required',
                'string',
                'max:255',
                Rule::unique('eventos', 'nombre_evento')->where(function ($query) use ($request) {
                    return $query->where('categoria', $request->input('categoria'));
                })->ignore($evento, 'id'),
            ],
            'descripcion_evento' => 'required|string',
            'categoria' => 'required|string|in:Diseño,QA,Desarrollo,Ciencia de datos',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
        $evento = Evento::where('user_id', '=', $user)->where('id', '=', $evento)->first();
        $evento->nombre_evento = $request->input('nombre_evento');
        $evento->descripcion_evento = $request->input('descripcion_evento');
        $evento->categoria = $request->input('categoria');
        $evento->fecha_inicio = $request->input('fecha_inicio');
        $evento->fecha_fin = $request->input('fecha_fin');
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

        // $png_url = "banner-" . time() . ".png";
        // $path = public_path() . '/storage/banners/' . $png_url;

        // Image::make(file_get_contents($request->input('imagen-banner')))->save($path);
        $png_url = "banner-" . time() . ".png";
        $file_content = file_get_contents($request->input('imagen-banner'));

        // Store the file in the public disk
        $url = Storage::disk('public')->url($png_url);
        Storage::disk('public')->put($png_url, $file_content);

        $eventoActual->direccion_banner = '/storage/' . $png_url;
        $eventoActual->update();
        return redirect()->route('misEventos')->with('status', '¡Banner actualizado exitosamente!.');
    }

    public function destroy($user, $evento)
    {

        $eventoActual = Evento::FindOrFail($evento);
        $eventoActual->estado = 'Cancelado';
        $eventoActual->update();
        return redirect()->route('misEventos')->with('status', 'Se cancelo el evento exitosamente');
    }

    public function guardarMap(Request $request, $id)
    {
        $request->validate([
            'latitud' => ['required', 'numeric', 'between:-85.05,85.05'],
            'longitud' => ['required', 'numeric', 'between:-179.99,179.99'],
        ], [
            'latitud.required' => 'El campo latitud debe ser un número.',
            'latitud.between' => 'La latitud esta fuera del limite.',
            'longitud.required' => 'El campo longitud debe ser un número.',
            'longitud.between' => 'La longitud esta fuera del limite.',
        ]);
        $evento = Evento::find($id);
        $evento->latitud = $request->latitud;
        $evento->longitud = $request->longitud;
        $evento->save();
        return redirect()->route('verEvento', ['id' => $id]);
        // return back();
    }
}
