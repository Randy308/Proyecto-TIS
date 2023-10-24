<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evento;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use DateTime;
class EventoList extends Component

{
    
    protected $paginationTheme = 'bootstrap';

    use WithPagination;
    public $filtroGestion;
    public $search ='';
    public $orderb = 0;
    public $filtroEstado = '';
    public $filtroCategoria = '';
    public $firstTime = true;
    public function render()
    {


         $eventos = Evento::where('nombre_evento','LIKE',"%{$this->search}%");
        if($this->firstTime){
            $mes = date('n');
            $anio = date('Y');
            $gesActual = "";
            if($mes <= 6){
                $gesActual = "I";
            }else{
                $gesActual = "II";  
            }
            $this->filtroGestion = json_encode(['anio' => $anio, 'gestion' => $gesActual]);
            $this->firstTime = false;
        }
        if($this->filtroGestion){
            $filg = json_decode($this->filtroGestion);
            $fI = $filg->anio;
            $fF = $filg->anio;
            if($filg->gestion == "I"){
                $fI = $fI . "-01-01";
                $fF = $fF ."-06-30";
            }else{
                $fI =  $fI . "-07-01";
                $fF =  $fF . "-12-31";
            }
            $eventos->whereBetween('fecha_inicio', [ $fI,$fF]);
        }else 
        if($this->filtroEstado){
            $eventos->where('estado',$this->filtroEstado);

        }
        if($this->filtroCategoria){
            $eventos->where('categoria',$this->filtroCategoria);
        }



         switch($this->orderb){
            case 0:
                $eventos->orderBy('fecha_inicio', 'desc');
                break;
            case 1:
                $eventos->orderBy('fecha_inicio', 'asc');
                break;
            case 2:
                $eventos->orderBy('nombre_evento', 'asc');
                break;
            case 3:
                $eventos->orderBy('nombre_evento', 'desc');
                break;

         } 
         
         

         $eventos = $eventos->paginate(6);
         
         foreach ($eventos as $evento) {
            $evento->fecha_inicio = new DateTime($evento->fecha_inicio);
            $evento->fecha_fin = new DateTime($evento->fecha_fin);
        }
        $gestiones = DB::table('eventos')
        ->select(DB::raw('DISTINCT YEAR(fecha_inicio) as anio'), DB::raw('CASE WHEN MONTH(fecha_inicio) <= 6 THEN "I" ELSE "II" END as gestion'))
        ->orderBy('anio', 'desc')
        ->orderBy('gestion', 'desc')
        ->get();


        return view('livewire.evento-list',  [
            'eventos' => $eventos,
            'gestiones' => $gestiones]);
    }

    public function updatingSearch(){

        $this->resetPage();
    }

}
