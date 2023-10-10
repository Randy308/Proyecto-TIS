<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evento;
use Livewire\WithPagination;
use DateTime;
class EventoList extends Component

{
    
    protected $paginationTheme = 'bootstrap';

    use WithPagination;
    public $search ='';
    public $orderb = 0;
    public $filtroEstado = '';
    public $filtroCategoria = '';


    public function render()
    {


         $eventos = Evento::where('nombre_evento','LIKE',"%{$this->search}%");
        if($this->filtroEstado){
            $eventos->where('estado',$this->filtroEstado);

        }
        if($this->filtroCategoria){
            $eventos->where('categoria',$this->filtroCategoria);
        }



         switch($this->orderb){
            case 0:
                $eventos->orderBy('fecha_inicio', 'asc');
                break;
            case 1:
                $eventos->orderBy('fecha_inicio', 'desc');
                break;
            case 2:
                $eventos->orderBy('nombre_evento', 'asc');
                break;
            case 3:
                $eventos->orderBy('nombre_evento', 'desc');
                break;

         } 
         
         

         $eventos = $eventos->paginate(6);
         $this->resetPage();
         foreach ($eventos as $evento) {
            $evento->fecha_inicio = new DateTime($evento->fecha_inicio);
            $evento->fecha_fin = new DateTime($evento->fecha_fin);
        }

        return view('livewire.evento-list',  [
            'eventos' => $eventos]);
    }

    public function updatedSearch(){
       
    }
}
