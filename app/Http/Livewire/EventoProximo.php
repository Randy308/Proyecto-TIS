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
        $evento = Evento::where('fecha_inicio', '>=', $todayDate)
            ->where('Estado', '=', 'Activo')
            ->orderBy('fecha_inicio', 'asc')
            ->first();
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
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
        return view('livewire.evento-proximo', compact('evento','mifechaFinal'));
    }
}
