<?php
namespace App\Http\Controllers;
use App\Models\CoordenadaEvento;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Evento;
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
        // $xNombreEvento = 400; // Cambia esto según tu diseño
        // $yNombreEvento = 100; // Cambia esto según tu diseño
        // $xFechaInicio = 200; // Cambia esto según tu diseño
        // $yFechaInicio = 150; // Cambia esto según tu diseño
        // $xFechaFin = 600; // Cambia esto según tu diseño
        // $yFechaFin = 150; // Cambia esto según tu diseño
    
        // CoordenadaEvento::create([
        //     'idEvento' => $evento->idEvento, // Asigna el ID del evento relacionado
        //     'nombreEx' => $xNombreEvento,
        //     'nombreEy' => $yNombreEvento,
        //     'fechaIX' => $xFechaInicio,
        //     'fechaIY' => $yFechaInicio,
        //     'fechaFX' => $xFechaFin,
        //     'fechaFY' => $yFechaFin,
        // ]);


        $nombreArchivo = "banner_$nombreEvento.png";
        $rutaBanner = public_path("storage/banners/$nombreArchivo"); // Directorio donde se guardarán los banners
        $banner->save($rutaBanner);
        return $rutaBanner;
    }
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

    public function crearEvento(Request $request)
    {
        try {
            $request->validate([
                'nombre_evento' => 'required|string|max:255',
                'descripcion_evento' => 'required|string',
                'estado' => 'required|in:activo,finalizado,cancelado',
                'categoria' => 'required|string',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after:fecha_inicio',
            ]);
    
            
            $rutaBanner = $this->generarBanner(
                $request->input('nombre_evento'),
                $request->input('fecha_inicio'),
                $request->input('fecha_fin')
            );
            $nombreDelArchivo = basename($rutaBanner);            
            $evento = new Evento([
                'nombre_evento' => $request->input('nombre_evento'),
                'descripcion_evento' => $request->input('descripcion_evento'),
                'estado' => $request->input('estado'),
                'categoria' => $request->input('categoria'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_fin' => $request->input('fecha_fin'),
                'direccion_banner' => $nombreDelArchivo,
            ]);
    
            $evento->save();
    
            return redirect('/#')->with('success', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');
        } catch (\Exception $e) {
            return redirect('/crear-evento')->with('failed', '¡Error no se guardo los datos');
        }
    }
    

}