<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Livewire\Component;

class ReportGeneral extends Component
{

    public $nombre_evento = "";
    public $tipoSeleccionado = "";
    public $estadoSeleccionado = "";
    public $privacidadSeleccionado = "";
    public $modalidadSeleccionado = "";
    public $fecha_desde = "";
    public $fecha_hasta = "";

    //usados para el checkbox
    public $mostrarEventosComprendidos = 0;
    public $checkboxdesabled = "disabled";
    public $checkboxopacidad = "opacity:0.5;";


    public function render()
    {

        $query = Evento::where('nombre_evento', 'like', '%' . $this->nombre_evento . '%');
//
        $existenComprendidos = clone $query;
        $existenComprendidos->where('fecha_inicio', '>=', $this->fecha_desde)
            ->where('fecha_fin', '>', $this->fecha_hasta);
        if (!empty($this->fecha_desde) && !empty($this->fecha_hasta) && $existenComprendidos->exists()) {
            $this->checkboxdesabled = "";
            $this->checkboxopacidad = "";
            if ($this->mostrarEventosComprendidos == 1) {
                $query->where('fecha_inicio', '>=', $this->fecha_desde)
                    ->where('fecha_inicio', '<=', $this->fecha_hasta);
            } else {
                $query->where('fecha_inicio', '>=', $this->fecha_desde);
                $query->where('fecha_fin', '<=', $this->fecha_hasta);
            }
        } else {
            $this->checkboxdesabled = "disabled";
            $this->checkboxopacidad = "opacity:0.5;";
            if (!empty($this->fecha_desde)) {
                $query->where('fecha_inicio', '>=', $this->fecha_desde);
            }
            if (!empty($this->fecha_hasta)) {
                $query->where('fecha_fin', '<=', $this->fecha_hasta);
            }
        }
//
        if (!empty($this->tipoSeleccionado)) {
            $query->where('tipo_evento', $this->tipoSeleccionado);
        }
        if (!empty($this->estadoSeleccionado)) {
            $query->where('estado', $this->estadoSeleccionado);
        }
        if (!empty($this->privacidadSeleccionado)) {
            $query->where('privacidad', $this->privacidadSeleccionado);
        }
        if (!empty($this->modalidadSeleccionado)) {
            $query->where('modalidad', $this->modalidadSeleccionado);
        }

        $eventos = $query->get();
        $tipos_eventos = Evento::distinct()->get('tipo_evento');

        return view('livewire.report-general', compact('eventos', 'tipos_eventos'));
    }
}
