
<div>
        <a href="#" class="nav-link" wire:click="cambiarEstadoNoti">
            <div class="icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                </svg>
                @if ($tieneNotificacionesNoVistas)
                    <span class="notificacion-punto-rojo"></span>
                @endif
            </div>
        </a>
        
        @if ($desplegado)
            
                <div  class="notificaciones-container" >
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Notificaciones</h5>
                        <button type="button" class="btn btn-primary" wire:click="irNotificaciones">Ver todo</button>
                    </div>
                    <div class="notificaciones-scroll-container">
                        @foreach ($notificaciones as $index =>$notificacion)
                        @if ($index <5)
                        
                            <div class="card notificacion-item shadow hover-shadow" wire:click="irEvento('{{$index}}')">
                                <div class="card-body">
                                    <h6 class="card-title">{{$nombresEventos[$index]}}
                                        @if ($notificacion->visto == 0)
                                            <span class="notificacion-punto-rojo-individual"></span>
                                        @endif
                                    </h6>
                                    <h6 class="card-title">{{$notificacion->asunto}}</h6>
                                    <p class="card-text">
                                        {{ Str::limit($notificacion->detalle, 50, '...') }}
                                    </p>
                                    <small>{{$tiempTrans[$index]}}</small>
                                </div>
                            </div>
                        @else
                            @break
                        @endif
                        
    
                    
                        @endforeach
                        </div>
                        @if ($notificaciones->isEmpty())
                            <div class="no-notificaciones">
                                <p>No tienes notificaciones</p>
                            </div>
                        @endif
    
                </div>
       
            
        @endif
            
        <script>
            setInterval(function() {
                Livewire.emit('actualizarDatos'); 
            }, 5000);
        
            
        </script>

</div>

