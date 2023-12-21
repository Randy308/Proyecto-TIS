<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Livewire\Component;
use App\Models\FaseEvento;
use DateTime;

class ActualizarCronograma extends Component
{
    protected $paginationTheme = 'bootstrap';

    public $idEvento;
    public $editable;
    public $faseId = '';
    public $faseActual;
    public $miFaseActual;
    public $primeravez = true;
   
     

    public function mount(){
        $seraFaseAct=FaseEvento::where('evento_id', $this->idEvento)
                            ->where('actual',1)->first();
                         
        date_default_timezone_set('America/La_Paz');
        $fechaHoraActual = date('Y-m-d H:i:s');

        if($seraFaseAct){
            if($seraFaseAct->fechaFin < $fechaHoraActual){
                if($seraFaseAct->secuencia == 1000){
                    $eventoEste=Evento::find($this->idEvento);
                    $eventoEste->estado='Finalizado';
                    $eventoEste->save(); 
                }else{
                    $seraFaseSig=FaseEvento::where('evento_id', $this->idEvento)
                            ->where('secuencia','>',$seraFaseAct->secuencia)
                            ->orderBy('secuencia')
                            ->first();
                    $seraFaseAct->actual=0;
                    $seraFaseAct->save();
                    $seraFaseSig->actual=1;
                    $seraFaseSig->save();  
                }
            }
        }
    }

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
        if ($this->primeravez) {
            $this->faseActual = $fases[0];
            $this->primeravez = false;
        }
        $editable = $this->editable;

        return view('livewire.actualizar-cronograma', compact('fases','editable'));
    }

    public function abrirEditar($faseId)
    {
        $this->faseActual = FaseEvento::find($faseId);


        //$this->emit('abrirelForm', $this->faseActual);
    }
}
