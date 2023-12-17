<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EventosCreados extends Component
{
    public function render()
    {   $user = User::findOrFail(Auth::id());
        $todayDate = now('GMT-4')->format('Y-m-d');
        $eventos = $user->eventos()->where('fecha_fin', '>=',  $todayDate)->where('estado', 'borrador')->get();
        //$eventos = $user->eventos()->where('fecha_fin', '>', Carbon::now())->where('estado', 'borrador')->get();
        return view('livewire.eventos-creados',['user'=> $user ,'eventos'=> $eventos]);
    }
}
