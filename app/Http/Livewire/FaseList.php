<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FaseEvento;
use DateTime;
class FaseList extends Component
{



    protected $paginationTheme = 'bootstrap';

    public $idEvento;
    public $editable;
    public $faseId = '';
    public $faseActual;
    public $primeravez = true;
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
        if($this->primeravez){
            $this->faseActual = $fases[0];
            $this->primeravez = false;
        }
        $editable = $this->editable;

        return view('livewire.fase-list', compact('fases','editable'));
    }

    public function abrirEditar($faseId)
    {
        $this->faseActual = FaseEvento::find($faseId);


        //$this->emit('abrirelForm', $this->faseActual);
    }



}
