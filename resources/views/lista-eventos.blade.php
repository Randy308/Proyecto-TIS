

@extends('layouts.app-listar')






<div class="wrapper">
    @include('layouts/sidebar')
    <div id="content">
        @include('layouts/navbar')
       
        
                <h1>Listado de Eventos</h1>
                
                @livewire('evento-list')

                
    </div>
</div>

