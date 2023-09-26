<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Evento;

class EventoControlador extends Controller
{
    public function crearEventoForm()
    {
        return view('crear-evento');
    }
    
    public function crearEvento(Request $request)
    {
        try {
            $request->validate([
                'Titulo' => 'required|string|max:255',
                'DireccionImg' => 'nullable|image|mimes:jpeg,png,gif', 
                'Descripcion' => 'required|string',
                'Estado' => 'required|string',
                'FechaInicio' => 'required|date',
                'FechaFin' => 'required|date|after:FechaInicio',
            ]);
            if ($request->hasFile('DireccionImg')) {
                $imagePath = $request->file('DireccionImg')->store('images', 'public');
                //$imagePath contiene la ruta de la imagen guardada en el almacenamiento público
            }
            $evento = new Evento([
                'Titulo' => $request->get('Titulo'),
                'DireccionImg' => $imagePath ?? null,
                'Descripcion' => $request->get('Descripcion'),
                'Estado' => $request->get('Estado'),
                'FechaInicio' => $request->get('FechaInicio'),
                'FechaFin' => $request->get('FechaFin'),
            ]);
            $evento->save();
    
            return redirect('/crear-evento')->with('success', '¡Evento creado exitosamente! Puedes seguir creando más eventos.');
        } catch (\Exception $e) {
            return redirect('/crear-evento')->with('failed', '¡Error no se guardo los datos');
        }
    }
    
    
}
