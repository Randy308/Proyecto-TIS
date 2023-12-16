<?php

namespace App\Http\Livewire;
use App\Models\Notificacion;
use App\Models\User;
use App\Models\AsistenciaEvento;
use App\Models\Evento;
use Livewire\Component;
use Illuminate\Support\Str;

use Carbon\Carbon;


class NotificacionesResumen extends Component
{
    public $notificaciones;
    public $us;
    public $nombresEventos = [];   
    public $desplegado = false;
    protected $listeners = ['actualizarDatos', 'mantenerDropdownAbierto' => '$refresh'];
    public $tiempTrans = [];
    public $tieneNotificacionesNoVistas= true;

    public function tiempoTranscurrido($fechaHora)
    {
        $fechaNotificacion = Carbon::parse($fechaHora);
        $ahora = Carbon::now();
        $diferencia = $ahora->diffInMinutes($fechaNotificacion);

        if ($diferencia < 60) {

            if($diferencia != 1){
                return "Hace $diferencia minutos";
            }else{
                return "Hace $diferencia minuto";
            }
           
        } elseif ($diferencia < 1440) {
            if($ahora->diffInHours($fechaNotificacion) != 1){
                return "Hace " . $ahora->diffInHours($fechaNotificacion) . " horas";
            }else{
                return "Hace " . $ahora->diffInHours($fechaNotificacion) . " hora";
            }

           
        } elseif ($diferencia < 44640) {
            if($ahora->diffInDays($fechaNotificacion) !=1){
                return "Hace " . $ahora->diffInDays($fechaNotificacion) . " días";
            }else{
                return "Hace " . $ahora->diffInDays($fechaNotificacion) . " día";
            }
            
        } else {
            return "Hace más de 31 días";
        }
    }



    public function cambiarEstadoNoti(){
        $this->desplegado = !$this->desplegado;

    }
    public function mount(){
        $this->actualizarDatos();
    }

    public function render()
    {
        return view('livewire.notificaciones-resumen');
    }
    public function marcarLeido(){
        $nots = Notificacion::where('user_id',auth()->user()->id)->where('visto',false)->orderBy('fechaHora','desc')->get();
        foreach($nots as $n){
            $n->visto = true;
            $n->save();
        }
        $this->tieneNotificacionesNoVistas = false;
        $this->notificaciones = Notificacion::where('user_id',auth()->user()->id)->orderBy('fechaHora','desc')->get();
    }

    public function irNotificaciones(){
        return redirect()->route('notificaciones');
    }
    public function irEvento($notificacionindex){
        $notificacion = $this->notificaciones[$notificacionindex];
        $notificacion->visto = true;
        $notificacion->save();
        return redirect()->route('verEvento',$notificacion->evento_id);
        
    }
    public function actualizarDatos()
    {
        $this->us = auth()->user()->name;

        $this->tiempTrans = [];
        $this->nombresEventos = [];
        $this->notificaciones = Notificacion::where('user_id',auth()->user()->id)->orderBy('fechaHora','desc')->get();
        $this->tieneNotificacionesNoVistas = $this->notificaciones->contains('visto', false);
        foreach($this->notificaciones as $noti){
            $this->tiempTrans[] = $this->tiempoTranscurrido($noti->fechaHora);
            $ev = $noti->evento()->first();
            $this->nombresEventos[] = $ev->nombre_evento;
        }
    }

}
