<?php

namespace App\Http\Controllers;

use App\Models\CoordenadaEvento;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\FaseEvento;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Institucion;


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
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha = Carbon::parse($evento->fecha_fin);
        $fecha_inicial = Carbon::parse($evento->fecha_inicio);
        $mes = $meses[($fecha->format('n')) - 1];
        $mes_inicial = $meses[($fecha_inicial->format('n')) - 1];
        //$miFechaInicial;
        if ($mes == $mes_inicial) {
            $miFechaInicial = $fecha_inicial->format('d') . ' y ';
        } else {
            $miFechaInicial = $fecha_inicial->format('d') . ' de ' . $mes_inicial . ' hasta el ';
        }
        $mifechaFinal = $miFechaInicial . $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
        return view('visualizar-evento', compact('evento', 'mifechaFinal'));
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

        $todayDate = now('GMT-4')->format('Y-m-d\TH:i');
        //return $request;
        //return $todayDate;

        $validator = $request->validate([
            'nombre_evento' => [
                'required',
                'string',
                'max:255',
                Rule::unique('eventos', 'nombre_evento')->ignore($request->input('id'), 'id'),
                'regex:/^[a-zA-Z0-9\s\.\-]+$/',
                'not_regex:/\b(?:concierto|fiesta|evento)\b/i',
                'not_in:registracion,registro,admin,event',
                'not_in:admin,user',
                'not_in:elija un nombre,seleccionar un nombre,ponga un nombre',
                'not_regex:/[!@#\$%\^&\*\(\)_\+=\[\]{};:\'",<>\?\/\\~`\|]+/',
            ],
            'privacidad' => 'required|in:libre,con-restriccion',

            'cantidad_minima' => 'nullable|integer|min:0',
            'cantidad_maxima' => 'nullable|integer|min:' . $request->input('cantidad_minima'),
            'tipo_evento' => 'required|in:reclutamiento,competencia_individual,competencia_grupal,taller_individual,taller_grupal', // Añadida validación para tipo de evento
            'descripcion_evento' => 'nullable|string',
            'fecha_inicio' => 'required|date_format:Y-m-d\TH:i|after_or_equal:' . $todayDate,
            'fecha_fin' => 'required|date_format:Y-m-d\TH:i|after_or_equal:fecha_inicio',

            "Auspiciadores" => "array",
            "Auspiciadores.*" => "string|distinct",
            'latitud' => 'required|numeric|between:-90,90',
            'longitud' => 'required|numeric|between:-180,180',
            'costo' => 'nullable|numeric|min:0',
            'institucion' => 'nullable|string',
        ], [
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_fin.required' => 'La fecha de finalización es obligatoria.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a la fecha actual.',
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'descripcion_evento.required' => 'La descripción del evento es obligatoria.',
            'descripcion_evento.string' => 'La descripción del evento debe ser una cadena de texto.',
            'privacidad.required' => 'La privacidad del evento es obligatoria.',
            'privacidad.in' => 'La privacidad del evento debe ser "publico" o "institucional".',
            'tipo_evento.required' => 'El tipo de evento es obligatorio.',
            'tipo_evento.in' => 'El tipo de evento no es válido.',
            'mostrarCantidadMinima.required' => 'Debe especificar si hay una cantidad mínima de participantes.',
            'mostrarCantidadMaxima.required' => 'Debe especificar si hay una cantidad máxima de participantes.',
            'cantidad_minima.required' => 'La cantidad mínima de participantes es obligatoria.',
            'cantidad_minima.integer' => 'La cantidad mínima de participantes debe ser un número entero.',
            'cantidad_minima.min' => 'La cantidad mínima de participantes debe ser al menos :min.',
            'cantidad_maxima.required' => 'La cantidad máxima de participantes es obligatoria.',
            'cantidad_maxima.integer' => 'La cantidad máxima de participantes debe ser un número entero.',
            'cantidad_maxima.gt' => 'La cantidad máxima de participantes debe ser mayor que la cantidad mínima.',
            'institucion.required_if' => 'Si selecciona una institución, debe especificar el nombre de la misma.',
            'institucion.string' => 'El nombre de la institución debe ser una cadena de texto.',
            'costo.numeric' => 'El costo debe ser un valor numérico.',
            'costo.min' => 'El costo no puede ser un número negativo.',
            'nombre_evento' => [
                'required' => 'El nombre del evento es obligatorio.',
                'string' => 'El nombre del evento debe ser una cadena de texto.',
                'max' => 'El nombre del evento no puede tener más de :max caracteres.',
                'unique' => 'El nombre del evento ya ha sido tomado. Por favor, elige un nombre único.',
                'regex' => 'El nombre del evento solo puede contener caracteres alfanuméricos, espacios, guiones y puntos.',
                'not_regex' => 'Evita el uso de ciertas palabras en el nombre del evento.',
                'not_in' => 'Evita el uso de ciertas palabras o frases comunes en el nombre del evento.',
            ],


        ]);
        $nombreEvento = preg_replace('/\s+/', ' ', trim($request->input('nombre_evento')));


        $background_color = '#21618C';
        $rutaBanner = $this->generarBanner(
            $nombreEvento,
            $request->input('fecha_inicio'),
            $request->input('fecha_fin'),
            $background_color,
        );
        // Get the datetime input from the request
        $datetimeInput1 = $request->input('fecha_inicio');

        // Convert the datetime input to a Carbon instance
        $carbonDatetime1 = Carbon::parse($datetimeInput1);

        // Extract date and time
        $dateInicio = $carbonDatetime1->toDateString(); // Format: Y-m-d
        $timeInicio = $carbonDatetime1->toTimeString(); // Format: H:i:s
        // Get the datetime input from the request
        $datetimeInput2 = $request->input('fecha_fin');

        // Convert the datetime input to a Carbon instance
        $carbonDatetime2 = Carbon::parse($datetimeInput2);

        // Extract date and time
        $dateFinal = $carbonDatetime2->toDateString(); // Format: Y-m-d
        $timeFinal = $carbonDatetime2->toTimeString(); // Format: H:i:s


        $nombreDelArchivo = basename($rutaBanner);

        $evento = new Evento();
        $evento->nombre_evento = $nombreEvento;
        if ($request->has('descripcion_evento')) {

            $descripcionEvento = preg_replace('/\s+/', ' ', trim($request->input('descripcion_evento')));
            $evento->descripcion_evento = $descripcionEvento;
        }
        if ($request->has('selectedInstitucion')) {
            $nombreInstitucion = $request->input('selectedInstitucion');
            $evento->nombre_institucion = $nombreInstitucion;
        }
        $evento->user_id = auth()->id();
        $evento->estado = 'Borrador';
        $evento->fecha_inicio = $dateInicio;
        $evento->fecha_fin = $dateFinal;

        $evento->tiempo_inicio = $timeInicio;
        $evento->tiempo_fin = $timeFinal;
        $evento->direccion_banner = '/storage/banners/' . $nombreDelArchivo;
        $evento->latitud = $request->input('latitud');
        $evento->longitud = $request->input('longitud');
        $evento->background_color = '#21618C';
        $evento->privacidad = $request->input('privacidad');
        $evento->tipo_evento = $request->input('tipo_evento');
        $evento->costo = $request->input('privacidad') === 'libre' ? null : floatval($request->input('costo'));
        $evento->cantidad_minima = $request->input('mostrarCantidadMinima') ? $request->input('cantidad_minima') : 0;
        $evento->cantidad_maxima = $request->input('mostrarCantidadMaxima') ? $request->input('cantidad_maxima') : null;
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

        $faseInscripcion = new FaseEvento([
            'evento_id' => $evento->id,
            'nombre_fase' => 'Fase de Inscripción',
            'descripcion_fase' => 'Mientras la fase de inscripción este activa podras incribirte al eveto',
            'fechaInicio' => $request->input('fecha_inicio'),
            'fechaFin' => $request->input('fecha_inicio'),
            'tipo' => 'Inscripcion',
            'secuencia' => 1,
            'actual' => true,
        ]);

        $faseInscripcion->save();
        $faseFinalizacion = new FaseEvento([
            'evento_id' => $evento->id,
            'nombre_fase' => 'Fase de  Cierre',
            'descripcion_fase' => 'El evento ya finalizo, pero aun puedes ver la información del evento',
            'fechaInicio' => $request->input('fecha_fin'),
            'fechaFin' => $request->input('fecha_fin'),
            'tipo' => 'Finalizacion',
            'secuencia' => 1000,
            'actual' => false,
        ]);

        $faseFinalizacion->save();

        return redirect()->route('misEventos')->with('status', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');
    }
    public function index()
    {
        $auspiciadores = Auspiciador::get();
        return view('crear-evento', compact('auspiciadores'));
    }
    public function indexPrueba()
    {
        $auspiciadores = Auspiciador::get();
        return view('prueba-crear-evento', compact('auspiciadores'));
    }
    public function edit($user, $evento)
    {
        $tiposEvento = ['reclutamiento', 'competencia_individual', 'competencia_grupal', 'taller_individual', 'taller_grupal'];
        $privacidades = ['libre', 'con-restriccion'];

        $miEvento = Evento::where('user_id', '=', $user)->where('id', '=', $evento)->first();
        $auspiciadores = Auspiciador::get();

        $fasesUltimas = FaseEvento::where('evento_id', $evento)
            ->orderBy('secuencia', 'desc')
            ->take(2)
            ->get();
            $fasesUltimas = $fasesUltimas->reverse();
        return view('actualizar-evento', compact('miEvento', 'tiposEvento', 'privacidades', 'auspiciadores','fasesUltimas'));
    }

    public function updateEstado($user, $evento, Request $request)
    {
        //
        $evento = Evento::where('user_id', '=', $user)->where('id', '=', $evento)->first();
        $evento->estado = 'Activo';
        $evento->save();
        return redirect()->route('misEventos')->with('status', '¡Se ha publicado el Evento exitosamente!.');
    }
    public function editBanner($user, $evento)
    {
        //
        $evento = Evento::findOrFail($evento);
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha = Carbon::parse($evento->fecha_fin);
        $fecha_inicial = Carbon::parse($evento->fecha_inicio);
        $mes = $meses[($fecha->format('n')) - 1];
        $mes_inicial = $meses[($fecha_inicial->format('n')) - 1];
        //$miFechaInicial;
        $miFechaInicial = 'Desde ' . $fecha_inicial->format('d') . ' de ' . $mes_inicial . ' del ' . $fecha_inicial->format('Y');
        $mifechaFinal = 'Hasta el ' . $fecha->format('d') . ' de ' . $mes . ' del ' . $fecha->format('Y');
        return view('editar-evento', ['evento' => $evento, 'miFechaInicial' => $miFechaInicial, 'mifechaFinal' => $mifechaFinal]);
    }
    public function update($user, $evento, Request $request)
    {

        $request->validate([
            'nombre_evento' => [
                'required',
                'string',
                'max:255',
                Rule::unique('eventos', 'nombre_evento')->ignore($request->input('nombre_evento'), 'nombre_evento'),
                'regex:/^[a-zA-Z0-9\s\.\-]+$/',
                'not_regex:/\b(?:concierto|fiesta|evento)\b/i',
                'not_in:registracion,registro,admin,event',
                'not_in:admin,user',
                'not_in:elija un nombre,seleccionar un nombre,ponga un nombre',
                'not_regex:/[!@#\$%\^&\*\(\)_\+=\[\]{};:\'",<>\?\/\\~`\|]+/',
            ],
            'privacidad' => 'required|in:libre,con-restriccion',

            'cantidad_minima' => 'required|integer|min:0',
            'cantidad_maxima' => 'required|integer|min:' . $request->input('cantidad_minima'),
            'tipo_evento' => 'required|in:reclutamiento,competencia_individual,competencia_grupal,taller_individual,taller_grupal', // Añadida validación para tipo de evento
            'descripcion_evento' => 'nullable|string',
            "Auspiciadores" => "array",
            "Auspiciadores.*" => "string|distinct",
            'latitud' => 'required|numeric|between:-90,90',
            'longitud' => 'required|numeric|between:-180,180',
            'costo' => 'nullable|numeric|min:0',
            'institucion' => 'nullable|string',
        ], [
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_fin.required' => 'La fecha de finalización es obligatoria.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a la fecha actual.',
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'descripcion_evento.required' => 'La descripción del evento es obligatoria.',
            'descripcion_evento.string' => 'La descripción del evento debe ser una cadena de texto.',
            'privacidad.required' => 'La privacidad del evento es obligatoria.',
            'privacidad.in' => 'La privacidad del evento debe ser "publico" o "institucional".',
            'tipo_evento.required' => 'El tipo de evento es obligatorio.',
            'tipo_evento.in' => 'El tipo de evento no es válido.',
            'cantidad_minima.required' => 'La cantidad mínima de participantes es obligatoria.',
            'cantidad_minima.integer' => 'La cantidad mínima de participantes debe ser un número entero.',
            'cantidad_minima.min' => 'La cantidad mínima de participantes debe ser al menos :min.',
            'cantidad_maxima.required' => 'La cantidad máxima de participantes es obligatoria.',
            'cantidad_maxima.integer' => 'La cantidad máxima de participantes debe ser un número entero.',
            'cantidad_maxima.gt' => 'La cantidad máxima de participantes debe ser mayor que la cantidad mínima.',
            'institucion.required_if' => 'Si selecciona una institución, debe especificar el nombre de la misma.',
            'institucion.string' => 'El nombre de la institución debe ser una cadena de texto.',
            'costo.numeric' => 'El costo debe ser un valor numérico.',
            'costo.min' => 'El costo no puede ser un número negativo.',
            'nombre_evento' => [
                'required' => 'El nombre del evento es obligatorio.',
                'string' => 'El nombre del evento debe ser una cadena de texto.',
                'max' => 'El nombre del evento no puede tener más de :max caracteres.',
                'regex' => 'El nombre del evento solo puede contener caracteres alfanuméricos, espacios, guiones y puntos.',
                'not_regex' => 'Evita el uso de ciertas palabras en el nombre del evento.',
                'not_in' => 'Evita el uso de ciertas palabras o frases comunes en el nombre del evento.',
            ],


        ]);

        $evento = Evento::where('user_id', $user)->where('id', $evento)->first();
        //
        // Get the datetime input from the request
        $datetimeInput1 = $request->input('fecha_inicio');

        // Convert the datetime input to a Carbon instance
        $carbonDatetime1 = Carbon::parse($datetimeInput1);

        // Extract date and time
        $dateInicio = $carbonDatetime1->toDateString(); // Format: Y-m-d
        $timeInicio = $carbonDatetime1->toTimeString(); // Format: H:i:s
        // Get the datetime input from the request
        $datetimeInput2 = $request->input('fecha_fin');

        // Convert the datetime input to a Carbon instance
        $carbonDatetime2 = Carbon::parse($datetimeInput2);

        // Extract date and time
        $dateFinal = $carbonDatetime2->toDateString(); // Format: Y-m-d
        $timeFinal = $carbonDatetime2->toTimeString(); // Format: H:i:s
        // Actualizar los campos del modelo con los nuevos nombres
        $evento->nombre_evento = $request->input('nombre_evento');
        $evento->descripcion_evento = $request->input('descripcion_evento');
        $evento->tipo_evento = $request->input('tipo_evento');
        $evento->fecha_inicio = $dateInicio;
        $evento->fecha_fin = $dateFinal;

        $evento->tiempo_inicio = $timeInicio;
        $evento->tiempo_fin = $timeFinal;
        $evento->privacidad = $request->input('privacidad');
        $evento->cantidad_minima = $request->input('cantidad_minima');
        $evento->cantidad_maxima = $request->input('cantidad_maxima');
        $evento->latitud = $request->input('latitud');
        $evento->longitud = $request->input('longitud');
        $evento->costo = $request->input('costo');
        if ($request->has('selectedInstitucion')) {
            $nombreInstitucion = $request->input('selectedInstitucion');
            $evento->nombre_institucion = $nombreInstitucion;
        }
        $evento->nombre_institucion = "UMSS";
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

        $eventoActual = Evento::FindOrFail($evento);
        $eventoActual->estado = 'Cancelado';
        $eventoActual->update();
        return redirect()->route('misEventos')->with('info', 'Se cancelo el evento');
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
    public function obtenerEventosReclutamiento()
    {
        $eventosReclutamiento = Evento::where('tipo_evento', 'reclutamiento')->get();

        return view('crear-evento', ['eventosReclutamiento' => $eventosReclutamiento]);
    }
}
