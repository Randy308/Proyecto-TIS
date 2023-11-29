<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MisEventosActivos extends Component
{
    public function render()
    {   $user = User::findOrFail(Auth::id());
        $todayDate = now('GMT-4')->format('Y-m-d');
        $eventos = $user->eventos()->where('fecha_fin', '>=',  $todayDate)->where('estado', 'activo')->get();
        //$eventos = $user->eventos()->where('fecha_fin', '>', Carbon::now())->where('estado', 'borrador')->get();
        return view('livewire.mis-eventos-activos',['user'=> $user ,'eventos'=> $eventos]);
    }
}
