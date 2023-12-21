<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionEventoEmail;
use App\Models\Evento;
use App\Models\Notificacion;
use App\Models\Grupo;
use App\Models\User;
use Carbon\Carbon;
use App\Models\AsistenciaEvento;
use App\Models\Colaborador;
use App\Models\PertenecenGrupo;

class EnviarNotis implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $evento;
    public $roles; 
    public $asunto;
    public $detalle;
    public $seleccionados;
    public $nombre_evento;
    public function __construct($evento,$roles,$asunto,$detalle,$nombre_evento,$seleccionados)
    {
        $this->seleccionados = $seleccionados;
        $this->evento = $evento;
        $this->roles = $roles;
        $this->asunto = $asunto;
        $this->detalle = $detalle;
        $this->nombre_evento = $nombre_evento;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
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
                                        $email = new NotificacionEventoEmail($this->asunto,
                                        $this->detalle,
                                        $admin->name,
                                        $this->nombre_evento);
                                        Mail::to($admin->email)->send($email); 
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
                                        $email = new NotificacionEventoEmail($this->asunto,
                                        $this->detalle,
                                        $user->name,
                                        $this->nombre_evento);
                                        Mail::to($user->email)->send($email);
                                    }
                                    
                                }
                
                
                
                            }
                        }




        
    }



}
