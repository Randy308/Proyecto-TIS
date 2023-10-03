

@extends('layouts.app')



@livewireStyles
@livewireScripts


@section('content')
    <div class="container">
        <h1>Listado de Eventos</h1>

        @livewire('evento-list')
    </div>
@endsection
