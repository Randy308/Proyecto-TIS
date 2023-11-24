<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FaseEvento;
use DateTime;
class FaseList extends Component
{



    protected $paginationTheme = 'bootstrap';

    public $idEvento;
    public $faseId = '';

    public function render()
    {
        $fases = FaseEvento::where('evento_id', $this->idEvento)
        ->orderBy('fechaInicio')
        ->orderBy('id')
        ->get();
        foreach ($fases as $fase) {
            $fase->fechaInicio = new DateTime($fase->fechaInicio);
            $fase->fechaFin = new DateTime($fase->fechaFin);
        }

        return view('livewire.fase-list', compact('fases'));
    }

   
}
