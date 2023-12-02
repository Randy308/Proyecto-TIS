<div class="tab1">
    <div class="row pb-4">
        <div class="col p-4" >
            <div class="row my-3 p-4 miCard">
                <p class="h4">Detalles</p>
                <span><i class="bi bi-person h3"></i> Evento de
                    <b>{{ ucfirst(trans($evento->user->name)) }}</b> </span>
                <span><i class="bi bi-tools h3"></i> Estado: <b class="{{ $evento->estado }}">{{ $evento->estado }}</b>
                </span>
                <span><i class="bi bi-people-fill h3"></i> <span>{{ count($evento->users) }} personas
                        participan</span></span>

                @if (!empty($evento->descripcion_evento))
                    <span><b>Descripción:</b>
                        <p>{{ $evento->descripcion_evento }}</p>
                    </span>
                @endif
            </div>
            <div class="row miCard p-4">
                <h4>Organizador</h4>
                <div class="row">
                    <div class="col-4">
                        <img src="{{ $evento->user->foto_perfil }}" class="card-img-top" alt="imagen no encontrada"
                            style="width:100px; height:100px">
                    </div>
                    <div class="col-6">
                        <span>Nombre: <b>{{ ucfirst(trans($evento->user->name)) }}</b></span>

                        <span>Email: <a href = "mailto:{{ $evento->user->email }}?subject = Feedback&body = Message"
                                class="btn btn-link emaillink">
                                {{ $evento->user->email }}
                            </a></span>

                    </div>
                </div>
            </div>
            @if ($evento->colaboradors->count())
                <div class="row my-4 p-4 miCard">

                    <h4>Colaboradores:</h4>
                    @foreach ($evento->colaboradors as $user)
                        <div class="row">
                            <div class="col-md-auto">
                                <img src="{{ $user->foto_perfil }}" class="card-img-top" alt="imagen no encontrada"
                                    style="width:50px; height:50px">
                            </div>
                            <div class="col">
                                <div class="row">
                                    <span>Nombre: <b>{{ ucfirst(trans($user->name)) }}</b></span>
                                </div>
                                <div class="row">
                                    <span>Email: <a
                                            href = "mailto:{{ $user->email }}?subject = Feedback&body = Message"
                                            class="btn btn-link emaillink">
                                            {{ $user->email }}
                                        </a></span>
                                </div>




                            </div>
                        </div>
                    @endforeach


                </div>
            @endif
        </div>
        <div class="col-md-auto d-flex justify-content-center m-4" >
            <div class="row">
                <div class="col">
                    <div class="p-2 my-4 miCard">
                        <p class="h4">Ubicación</p>
                    </div>
                    <div id="participantesContainer" class="d-flex justify-content-center align-items-center">
                        <div class="card" id="participantes">
        
        
                            <input type="hidden" class="form-control" name="latitud" id="latitud"
                                value="{{ $evento->latitud }}">
                            <input type="hidden" class="form-control" name="longitud" id="longitud"
                                value="{{ $evento->longitud }}">
                            <div id="mapa"></div>
        
        
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col miCard p-4 m-4">
            @if ($evento->privacidad == 'con-restriccion')
                <p class="h4">Requisitos</p>

                <div class="row">

                    @if (!empty($evento->costo))
                        <span>Costo de inscripcion: <span><b>{{ $evento->costo }}</b> Bs</span>
                            </span>
                    @endif
                    @if (!empty($evento->cantidad_minima))
                        <span>Plazas limitadas, unicamenete para
                            <span><b>{{ $evento->cantidad_minima }}</b> participantes</span>
                        </span>
                    @endif
                    @if (!empty($evento->nombre_institucion))
                        <span>Ser estudiante regulara de la
                            <span><b>{{ $evento->nombre_institucion }}</b></span>
                        </span>
                    @endif
                </div>
            @else
            <p class="h4">Inscripciones abiertas</p>

            @endif

        </div>
    </div>
</div>
