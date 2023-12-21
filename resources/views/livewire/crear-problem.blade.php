<div>
    <div class="container py-4 my-4" style="background-color:white;border-radius:20px;border: solid whitesmoke;">
        <div class="d-flex justify-content-end">
            <a class="btn btn-danger" href="{{ route('misEventos', ['tab' => 1]) }}" type="submit"><i
                    class="bi bi-x-lg"></i></a>
        </div>
        <p class="h4">{{$evento->nombre_evento}}</p>
        <p class="h6">Lista de Problemas</p>
        <div class="py-4">
            <!-- Button trigger modal -->
            
                <button type="button" class="btn btn-primary btn-sm" wire:click="openModal">
                    Crear Problema
                </button>
                @if($isModalOpen)
                    
                    @if (strtoupper($evento->modalidad) == 'GRUPAL')
                        @livewire('modal-grupal-problema',['eventoId' => $eventoId])
                    @else
                        @livewire('modal-individual-problema',['eventoId' => $eventoId])
                    @endif
                    <div style="position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1040;background-color: #000; opacity:0.5;"></div>
                @endif
        
        </div>

{{-- tablas --}}

    </div>
</div>
