<?php

namespace App\Http\Livewire;

use App\Jobs\EnviarNotis;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Notificacion;
use App\Models\Grupo;
use App\Models\AsistenciaEvento;
use App\Models\Colaborador;
use App\Models\PertenecenGrupo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionEventoEmail;
class NotificacionesForm extends Component
{

    public $evento;
    public $mostrarEsperar = false;
    public $roles;
    public $asunto;
    public $detalle;
    public $seleccionados;
    public $oculto;
    public function cambiarOculto(){
        $this->oculto = !$this->oculto;
    }
    public function mount(){
        $this->roles = Role::all();
        $this->oculto = false;
        foreach($this->roles as $rol){
            $this->seleccionados[] = false;
        }
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function actualizarSeleccionados($index){
        $this->seleccionados[$index] = !$this->seleccionados[$index];
    }

    public function espere(){
        $this->validate();
        $this->mostrarEsperar = true;
        $this->crearNotificaciones();
    }

    public function crearNotificaciones(){   
                    $alMenosUnoVerdadero = in_array(true, $this->seleccionados, true);
                    if($alMenosUnoVerdadero){
                        $emailjob = (new EnviarNotis($this->evento,$this->roles,$this->asunto,$this->detalle,$this->evento->nombre_evento,$this->seleccionados));
                        dispatch($emailjob);
                        $this->mostrarEsperar = false;
                        return redirect()->route('misEventos',['tab' => 1])->with('status', 'se enviaron las notificaciones correctamente');

                    }else{
                        $this->mostrarEsperar = false;
                        return redirect()->route('misEventos',['tab' => 1])->with('inf', 'no hubieron destinatarios');
                    }
                    
        
    }
    public function render()
    {
        return view('livewire.notificaciones-form');
    }

    protected $rules =  [
        'seleccionados.*'=>'required',
        'asunto'=>'required',
        'detalle'=>'required',
        
    ];
}
