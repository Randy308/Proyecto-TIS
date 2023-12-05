<?php

namespace App\Http\Livewire;
use App\Models\Notificacion;
use App\Models\User;
use App\Models\AsistenciaEvento;
use Livewire\Component;

class NotificacionesResumen extends Component
{
    public $notificaciones;
    public $us;
    public $desplegado;
    protected $listeners = ['actualizarDatos', 'mantenerDropdownAbierto' => '$refresh'];


    public function cambiarEstadoNoti(){
        $this->desplegado = !$this->desplegado;
    }
    public function mantenerDropdownAbierto()
    {
       
    }
    public function render()
    {
        $this->desplegado = false;
        $this->actualizarDatos();
        return view('livewire.notificaciones-resumen');
    }




    public function actualizarDatos()
    {
        $this->us = auth()->user()->name;
        $asistencias = AsistenciaEvento::where('user_id',auth()->user()->id)->get();
        $idsAsis = $asistencias->pluck('id')->toArray();

        $this->notificaciones = Notificacion::whereIn('asistencia_id',$idsAsis)->orderBy('fechaHora','desc')->get();
        $this->emit('mantenerDropdownAbierto');
    }

}
