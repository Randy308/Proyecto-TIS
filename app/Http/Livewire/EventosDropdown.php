<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Institucion;

class EventosDropdown extends Component
{
    public $eventos;
    public $instituciones;
    public $selectedEvento;
    public $tipoEventoSeleccionado;
    public $showEventos;
    public $showInstitucion = false;
    public $selectedInstitucion;

    public function mount()
    {
        // $this->inicializarEventosDropdown('competencia_individual'); // Tipo de evento por defecto
        $this->instituciones = Institucion::pluck('nombre_institucion');
    }

    public function render()
    {
        return view('livewire.eventos-dropdown');
    }

    public function updatedTipoEventoSeleccionado($value)
    {
        $this->tipoEventoSeleccionado = $value;
        $this->showEventos = in_array($value, ['competencia_grupal', 'competencia_individual']);
        $this->showInstitucion = false;
        $this->inicializarEventosDropdown($value);
        $this->emit('actualizarTipoEvento', $value);

        // Reiniciar valores de eventos y institución al cambiar el tipo de evento
        $this->selectedEvento = null;
        $this->selectedInstitucion = null;
    }

    public function updatedSelectedInstitucion($value)
    {
        logger()->info('Selected Institucion: ' . $value);
    }

    private function inicializarEventosDropdown($tipoEvento)
    {
        $this->eventos = [];

        if (in_array($tipoEvento, ['competencia_grupal', 'competencia_individual'])) {
            // Solo carga los eventos si el tipo de evento es competencia_grupal o competencia_individual
            $this->eventos = Evento::where('tipo_evento', $tipoEvento)->pluck('nombre_evento', 'id');
        }
    }
}
