<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FaseEvento;
use App\Models\Evento;
use App\Models\Grupo;
use App\Models\AsistenciaEvento;
use App\Models\Colaborador;
use App\Models\PertenecenGrupo;
use App\Models\Notificacion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionEventoEmail;
use DateTime;
use Illuminate\Console\Scheduling\Event;

class ActualizarFases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fases:actualizar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cambia entre fases de un evento';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $eventos = Evento::where('estado', 'Activo')->get();
        $idsEventos = $eventos->pluck('id');
        $fases = FaseEvento::where('actual',true)->whereIn('evento_id',$idsEventos)->get(); 
        foreach ($fases as $fase) {
            $datetimeInput =$fase->fechaFin;
            $carbonDatetime = Carbon::parse($datetimeInput);
            if ($carbonDatetime->lessThanOrEqualTo(Carbon::now())) {
                $evento = Evento::where('id',$fase->evento_id)->first();
                $grupos = Grupo::where('evento_id',$evento->id)->get();
                $asistencias = AsistenciaEvento::where('evento_id',$evento->id)->get(); 
                $colaboradores = Colaborador::where('evento_id',$evento->id)->get();   
                $perteneceGrupos = PertenecenGrupo::where('evento_id',$evento->id)->get();
                $userIdsGrupos = $grupos->pluck('user_id')->toArray();
                $organizador = User::find($fase->evento_id);
                $userIdsAsistencias = $asistencias->pluck('user_id')->toArray();
                $userIdsColaboradores = $colaboradores->pluck('user_id')->toArray();
                $userIdsPerteneceGrupos = $perteneceGrupos->pluck('user_id')->toArray();
                $combinedUserIds = array_unique(array_merge(
                            $userIdsGrupos,
                            $userIdsAsistencias,
                            $userIdsColaboradores,
                            $userIdsPerteneceGrupos,
                            [$organizador->id]
                ));
                $fase->actual = false; 
                $fase->save();
                if($fase->tipo != 'Finalizacion'){
                    $proxFase = FaseEvento::where('evento_id', $fase->evento_id)
                    ->where('secuencia', '>',  $fase->secuencia)
                    ->orderBy('secuencia')
                    ->first();
                        $proxFase->actual = true;
                        $proxFase->save();
                        foreach($combinedUserIds as $usid){
                            $user = User::find($usid);
                            $not = new Notificacion();//trim($request->input('nombre_evento'))
                            $not->asunto = 'El evento '.$evento->nombre_evento.' entro en una nueva fase';
                            $not->detalle = 'El evento '.$evento->nombre_evento.' acaba de entrar en la fase de '.$proxFase->nombre_fase;
                            $not->fechaHora = Carbon::now();
                            $not->visto = false;
                            $not->evento()->associate($evento);
                            $not->user()->associate($user);
                            $not->save();
                            Mail::to($user->email)->send(new NotificacionEventoEmail($not->asunto,$not->detalle, $user->name, $not->evento->nombre_evento));
                        }
                        
                }else{
                    $evento = Evento::where('id',$fase->evento_id)->first();
                    $evento->estado = 'Finalizado';
                    $evento->save();


                    foreach($combinedUserIds as $usid){
                        $user = User::find($usid);
                        $not = new Notificacion();//trim($request->input('nombre_evento'))
                        $not->asunto = 'Evento '.$evento->nombre_evento.' finalizado';
                        $not->detalle = 'El evento '.$evento->nombre_evento.' acaba de finalizar';
                        $not->fechaHora = Carbon::now();
                        $not->visto = false;
                        $not->evento()->associate($evento);
                        $not->user()->associate($user);
                        $not->save();
                        Mail::to($user->email)->send(new NotificacionEventoEmail($not->asunto,$not->detalle, $user->name, $not->evento->nombre_evento));
                    }

                }

            }
        }

        $this->info('Se Actualizaron las fases con exito');
        return 0;
    }
}
