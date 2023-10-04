

@extends('layouts.app')



@livewireStyles
@livewireScripts

<div class="wrapper">
    @include('layouts/sidebar')
    <div id="content">
        @include('layouts/navbar')
       
        
                <h1>Listado de Eventos</h1>

                @livewire('evento-list')


    </div>
</div>

