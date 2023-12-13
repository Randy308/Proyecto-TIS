<?php

namespace App\Http\Livewire;

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

  

    public function crearNotificaciones(){
                    $this->validate();
                    $alMenosUnoVerdadero = in_array(true, $this->seleccionados, true);
                    if($alMenosUnoVerdadero){
                        $grupos = Grupo::where('evento_id',$this->evento->id)->get();


                        $asistencias = AsistenciaEvento::where('evento_id',$this->evento->id)->get();
    
                        $colaboradores = Colaborador::where('evento_id',$this->evento->id)->get();
                      
    
                        $perteneceGrupos = PertenecenGrupo::where('evento_id',$this->evento->id)->get();
                        
    
                        $userIdsGrupos = $grupos->pluck('user_id')->toArray();
                        $userIdsAsistencias = $asistencias->pluck('user_id')->toArray();
                        $userIdsColaboradores = $colaboradores->pluck('user_id')->toArray();
                        $userIdsPerteneceGrupos = $perteneceGrupos->pluck('user_id')->toArray();
    
                        $combinedUserIds = array_unique(array_merge(
                            $userIdsGrupos,
                            $userIdsAsistencias,
                            $userIdsColaboradores,
                            $userIdsPerteneceGrupos
                        ));
                        foreach( $this->seleccionados as $index =>$selec){
                            if($selec){
                                if($this->roles[$index]->name == 'administrador'){
                                    $admins = User::whereHas('roles', function ($query) {
                                        $query->where('name', 'administrador');
                                    })->get();
                                    foreach($admins as $admin){
                                        $not = new Notificacion();//trim($request->input('nombre_evento'))
                                        $not->asunto = $this->asunto;
                                        $not->detalle = $this->detalle;
                                        $not->fechaHora = Carbon::now();
                                        $not->visto = false;
                                        $not->evento()->associate($this->evento);
                                        $not->user()->associate($admin);
                                        $not->save();
                                        Mail::to($admin->email)->send(new NotificacionEventoEmail($this->asunto,$this->detalle, $admin->name, $this->evento->nombre_evento));
                                    }
                                }else{
                                    $rolname = $this->roles[$index]->name;
                                    $users = User::whereIn('id', $combinedUserIds)
                                            ->whereHas('roles', function ($query) use ($rolname) {
                                                $query->where('name',$rolname );
                                            })
                                            ->get();
                
                                    foreach($users as $user){
                                        $not = new Notificacion();//trim($request->input('nombre_evento'))
                                        $not->asunto = $this->asunto;
                                        $not->detalle = $this->detalle;
                                        $not->fechaHora = Carbon::now();
                                        $not->visto = false;
                                        $not->evento()->associate($this->evento);
                                        $not->user()->associate($user);
                                        $not->save();
                                        Mail::to($user->email)->send(new NotificacionEventoEmail($this->asunto,$this->detalle, $user->name, $this->evento->nombre_evento));
                                    }
                                    
                                }
                
                
                
                            }
                        }
              
                        return redirect()->route('misEventos',['tab' => 1])->with('status', 'se enviaron las notificaciones correctamente');

                    }else{
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
