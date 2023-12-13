<div >
            <div  class="notificaciones-containerList" >
                <div class="d-flex justify-content-center align-items-center">
                </div>
                <div class="notificaciones-scroll-container">
                    @foreach ($notificaciones as $index =>$notificacion)
                    
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
                    
                    @endforeach
                    </div>
                    @if ($notificaciones->isEmpty())
                        <div class="no-notificaciones">
                            <p>No tienes notificaciones</p>
                        </div>
                    @endif
            </div>
</div>
