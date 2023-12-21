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

use function PHPUnit\Framework\isEmpty;

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
    public function cerrar(){
        return redirect()->route('misEventos',['tab' => 1]);
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
                        $grupos = Grupo::where('evento_id',$this->evento->id)->get();
                        $asistencias = AsistenciaEvento::where('evento_id',$this->evento->id)->get();
                        $organizador = User::find($this->evento->user_id);
                        $colaboradores = Colaborador::where('evento_id',$this->evento->id)->get();
                      
    
                        $perteneceGrupos = PertenecenGrupo::where('evento_id',$this->evento->id)->get();
                        
                        $org = $organizador->id;
                        $userIdsGrupos = $grupos->pluck('user_id')->toArray();
                        $userIdsAsistencias = $asistencias->pluck('user_id')->toArray();
                        $userIdsColaboradores = $colaboradores->pluck('user_id')->toArray();
                        $userIdsPerteneceGrupos = $perteneceGrupos->pluck('user_id')->toArray();
    
                        $combinedUserIds = array_unique(array_merge(
                            $userIdsGrupos,
                            $userIdsAsistencias,
                            $userIdsColaboradores,
                            $userIdsPerteneceGrupos,
                            [$org]
                        ));
                        $almenos1 = false;
                        foreach($this->roles as $index => $rol){
                            $rolname = $this->roles[$index]->name;
                            if($this->seleccionados[$index]){
                                $users = User::whereIn('id', $combinedUserIds)
                                            ->whereHas('roles', function ($query) use ($rolname) {
                                                $query->where('name',$rolname );
                                            })
                                            ->get();
                                if(!$users->isEmpty()){
                                    $almenos1 = true;
                                }
                            }
                        }

                        if($almenos1){
                            $emailjob = (new EnviarNotis($this->evento,$this->roles,$this->asunto,$this->detalle,$this->evento->nombre_evento,$this->seleccionados));
                            dispatch($emailjob);
                            $this->mostrarEsperar = false;
                            return redirect()->route('misEventos',['tab' => 1])->with('status', 'se enviaron las notificaciones correctamente');
                        }else{
                            $this->mostrarEsperar = false;
                            return redirect()->route('misEventos',['tab' => 1])->with('inf', 'no hubieron destinatarios');
                        }

                       

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
