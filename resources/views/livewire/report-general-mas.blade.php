<div class="mx-4">
    <div class="container bg-white pt-4 my-3 border rounded">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre_evento" class="fw-bold">Nombre Evento:</label>
                    <span>{{$evento->nombre_evento}}</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fecha_inicio" class="fw-bold">Fecha Inicio:</label>
                    <span>{{$evento->fecha_inicio}}</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fecha_fin" class="fw-bold">Fecha Fin:</label>
                    <span>{{$evento->fecha_fin}}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tipo" class="fw-bold">Tipo Evento: </label>
                    <span>{{$evento->tipo_evento}}</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="estado" class="fw-bold">Estado:</label>
                    <span>{{$evento->estado}}</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="privacidad" class="fw-bold">Privacidad:</label>
                    <span>{{$evento->privacidad}}</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="modalidad" class="fw-bold">Modalidad:</label>
                    <span>{{$evento->modalidad}}</span>
                </div>
            </div>
        </div>
    </div>
    
    {{--  --}}
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        {{-- <li class="nav-item dropdown" role="presentation" aria-expanded="true">
            <button class="nav-link dropdown-toggle active" style="padding-right:35px;" data-bs-toggle="dropdown" aria-expanded="false">
                Participantes
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item active" id="usuario-comun-tab" data-bs-target="#usuario-comun-tab-pane" data-bs-toggle="tab" role="tab" aria-controls="usuario-comun-tab-pane" aria-selected="true">Usuario Comun</a></li>
                <li><a class="dropdown-item" id="organizador-tab" data-bs-target="#organizador-tab-pane" data-bs-toggle="tab" role="tab" aria-controls="organizador-tab-pane" aria-selected="false">Organizador</a></li>
                <li><a class="dropdown-item" id="colaborador-tab" data-bs-target="#colaborador-tab-pane" data-bs-toggle="tab" role="tab" aria-controls="colaborador-tab-pane" aria-selected="false">colaborador</a></li>
                <li><a class="dropdown-item" id="coach-tab" data-bs-target="#coach-tab-pane" data-bs-toggle="tab" role="tab" aria-controls="coach-tab-pane" aria-selected="false">coach</a></li>
            </ul>
        </li> --}}
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="equipos-tab" data-bs-toggle="tab" data-bs-target="#equipos-tab-pane" type="button" role="tab" aria-controls="equipos-tab-pane" aria-selected="true">
                @if ($evento->modalidad == 'individual')
                    Participantes
                @else
                    Equipos
                @endif
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="fases-tab" data-bs-toggle="tab" data-bs-target="#fases-tab-pane" type="button" role="tab" aria-controls="fases-tab-pane" aria-selected="false">Fases</button>
        </li>  
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="clasificacion-tab" data-bs-toggle="tab" data-bs-target="#clasificacion-tab-pane" type="button" role="tab" aria-controls="clasificacion-tab-pane" aria-selected="false">Clasificacion</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        {{-- <div class="tab-pane fade show active" id="usuario-comun-tab-pane" role="tabpanel" aria-labelledby="usuario-comun-tab" tabindex="0">
            @livewire('report-usuario-comun-evento',['eventoId' => $evento->id])
        </div>
        <div class="tab-pane fade" id="organizador-tab-pane" role="tabpanel" aria-labelledby="organizador-tab" tabindex="0">
            organizador
            @livewire('report-organizador-evento')
        </div>
        <div class="tab-pane fade" id="colaborador-tab-pane" role="tabpanel" aria-labelledby="colaborador-tab" tabindex="0">
            colaborador
            @livewire('report-colaborador-evento')
        </div>
        <div class="tab-pane fade" id="coach-tab-pane" role="tabpanel" aria-labelledby="coach-tab" tabindex="0">
            coach
            @livewire('report-coach-evento')
        </div> --}}
        <div class="tab-pane fade show active" id="equipos-tab-pane" role="tabpanel" aria-labelledby="equipos-tab" tabindex="0">
            @livewire('report-equipo-evento',['eventoId' => $evento->id])
        </div>
        <div class="tab-pane fade" id="fases-tab-pane" role="tabpanel" aria-labelledby="fases-tab" tabindex="0">
            @livewire('report-fase-evento',['eventoId' => $evento->id])
        </div>
        <div class="tab-pane fade" id="clasificacion-tab-pane" role="tabpanel" aria-labelledby="clasificacion-tab" tabindex="0">
            @livewire('report-clasificacion-evento',['eventoId' => $evento->id])
        </div>
    </div>
    {{--  --}}

</div>
