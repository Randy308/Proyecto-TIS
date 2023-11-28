<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Carbon\Carbon;
use Livewire\Component;

class EventoProximo extends Component
{
    public function render()
    {
        $todayDate = now('GMT-4')->format('Y-m-d');
        $todayTime = now('GMT-4')->format('H:i:s');

        // $eventosCaducados = Evento::where('fecha_fin', '<=', $todayDate)->where('tiempo_fin', '<', $todayTime)->where('Estado', '=', 'Activo')->get();

        // foreach ($eventosCaducados as $eventoCaducado) {
        //     $eventoCaducado->estado = "Finalizado";
        //     //$eventoCaducado->save();
        // }


        $evento = Evento::where('estado', 'Activo')
        ->where(function ($query) use ($todayDate, $todayTime) {
            $query->where('fecha_inicio', '>=', $todayDate)
                  ->orWhere(function ($innerQuery) use ($todayDate, $todayTime) {
                      $innerQuery->where('fecha_fin', '>=', $todayDate)
                                  ->where('tiempo_fin', '>=', $todayTime);
                  });
        })
        ->orderBy('fecha_inicio', 'asc')
        ->first();


        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $mifechaFinal = null;
        if ($evento) {
            $fecha = Carbon::parse($evento->fecha_fin);
            $fecha_inicial = Carbon::parse($evento->fecha_inicio);
            $mes = $meses[($fecha->format('n')) - 1];
            $mes_inicial = $meses[($fecha_inicial->format('n')) - 1];
            //$miFechaInicial;
            if ($mes == $mes_inicial) {
                $miFechaInicial = $fecha_inicial->format('d') . ' y ';
            } else {
                $miFechaInicial = $fecha_inicial->format('d') . ' de ' . $mes_inicial . ' - ';
            }
            $mifechaFinal = $miFechaInicial . $fecha->format('d') . ' de ' . $mes . ' ' . $fecha->format('Y');
        } else {

        }

        return view('livewire.evento-proximo', compact('evento', 'mifechaFinal'));
    }
}
