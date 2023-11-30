<div id="FormCrearEvento">
    <div class="row pt-4 pb-4">
        <div class="card">
            {{-- contenedor modal y banner  --}}
            <div id="contenedor_bannerM" class="contenedor-banner position-relative">
                {{-- <div id="fondotransparente"></div> --}}
                <img src="{{ asset($evento->direccion_banner) }}" alt="logo-banner" id="miBanner" />
            </div>
            {{--  --}}
            <div class="div-titulos p-4">
                <div class="row">
                    <div class="col">
                        <h5>Fecha: <b>{{ $mifechaFinal }}</b></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h1 id="miTitulo">{{ $evento->nombre_evento }}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                        <h6>Tipo de evento: <b> {{ $evento->tipo_evento }}</b></h6>
                    </div>
                    <div class="col ">
                        <div class="div-btn d-flex justify-content-end">
                            @php
                                $fechaCompleta = $evento->fecha_inicio . ' ' . $evento->tiempo_inicio;
                                $fechaFinal = $evento->fecha_fin . ' ' . $evento->tiempo_fin;

                            @endphp
                            @if (strtotime($fechaCompleta) >= strtotime(now('GMT-4')))
                                @guest
                                    <button class="btn btn-primary" id="boton-registro" role="button" data-toggle="modal"
                                        data-target="#loginModal">
                                        Iniciar Sesion
                                    </button>

                                @endguest
                                @auth
                                    @if (auth()->user()->hasRole('usuario común') ||
                                            auth()->user()->hasRole('Coach'))
                                        @php
                                            //existe registro tabla individual
                                            $id_evento_pagina = $evento->id;
                                            $id_usuario = auth()->user()->id;
                                            $registroExistente = \App\Models\AsistenciaEvento::where('user_id', $id_usuario)
                                                ->where('evento_id', $id_evento_pagina)
                                                ->exists();
                                            //existe registro en tabla de grupos
                                            $participanteEngrupodelEvento = \App\Models\PertenecenGrupo::where('user_id', $id_usuario)
                                                ->where('evento_id', $id_evento_pagina)
                                                ->exists();
                                            //nombre de grupo de usuario registrado
                                            $registroExistente1 = \App\Models\PertenecenGrupo::where('user_id', $id_usuario)
                                                ->where('evento_id', $id_evento_pagina)
                                                ->first();
                                            if ($registroExistente1 !== null) {
                                                $id = $registroExistente1->grupo_id;
                                                $grupo = App\Models\Grupo::find($id);
                                                $nombreGrupo = $grupo->nombre;
                                            }
                                        @endphp
                                        @if ($registroExistente || $participanteEngrupodelEvento)
                                            @if (
                                                $evento->tipo_evento == 'competencia_individual' ||
                                                    $evento->tipo_evento == 'reclutamiento' ||
                                                    $evento->tipo_evento == 'taller_individual')
                                                <div class="dropdown" id="lista-registro">
                                                    <a class="btn btn-secondary dropdown-toggle" href="#"
                                                        role="button" id="dropdownMenuLink boton-registro"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ya se encuentra <br>registrado en el evento
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#abandonarModal">Abandonar evento</a>

                                                    </div>
                                                </div>
                                                @include('abandonar-evento', ['evento' => $evento])
                                            @else
                                                <span class="text-center alert alert-success">Grupo:
                                                    {{ $nombreGrupo }}</span>
                                            @endif
                                        @else
                                            @if (strtoupper($evento->estado) == 'CANCELADO')
                                                <button type="button" disabled class="btn btn-danger" id="boton-registro">
                                                    Evento cancelado
                                                </button>
                                            @elseif(strtoupper($evento->estado) == 'FINALIZADO')
                                                <button type="button" disabled class="btn btn-primary" id="boton-registro">
                                                    Evento finalizado
                                                </button>
                                            @elseif (strtoupper($evento->estado) == 'ACTIVO')
                                                @if (
                                                    $evento->tipo_evento == 'competencia_individual' ||
                                                        $evento->tipo_evento == 'reclutamiento' ||
                                                        $evento->tipo_evento == 'taller_individual')
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#modalRegistroParticipanteEvento">
                                                        Registrarse
                                                    </button>
                                                    @include('layouts.modal-registro-evento')
                                                @else
                                                    <a href="{{ route('registroEquipo.view', ['evento_id' => $evento->id]) }}"
                                                        class="btn btn-success" id="">
                                                        Registar Equipo
                                                    </a>
                                                @endif
                                            @else
                                                <button type="button" disabled class="btn btn-info" id="boton-registro">
                                                    Registro no disponible
                                                </button>
                                            @endif
                                        @endif
                                    @else
                                        <button type="button" disabled class="btn btn-info" id="boton-registro">
                                            Inscripción solo para<br>participantes y entrenadores.
                                        </button>
                                    @endif




                                @endauth
                            @elseif (strtotime($fechaFinal) >= strtotime(now('GMT-4')))
                                @guest
                                    <button type="button" disabled class="btn btn-primary" id="boton-registro">
                                        Evento en progreso <br>no se admiten mas incripciones
                                    </button>
                                @endguest
                                @auth
                                    @php
                                        $id_evento_pagina = $evento->id;
                                        $id_usuario = auth()->user()->id;
                                        $registroExistente = \App\Models\AsistenciaEvento::where('user_id', $id_usuario)
                                            ->where('evento_id', $id_evento_pagina)
                                            ->exists();
                                    @endphp
                                    @if ($registroExistente)
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-secondary"
                                                href="{{ route('fases.fasesdeEvento', ['evento' => $evento->id]) }}">
                                                Fases
                                            </a>
                                            <button type="button" class="btn btn-info" disabled> Ya esta <br>registrado
                                                en el evento</button>

                                        </div>
                                    @else
                                        <button type="button" disabled class="btn btn-primary" id="boton-registro">
                                            Evento en progreso <br>no se admiten mas incripciones
                                        </button>
                                    @endif
                                @endauth
                            @else
                                <button type="button" disabled class="btn btn-primary" id="boton-registro">
                                    Evento finalizado
                                </button>

                            @endif


                        </div>
                    </div>
                </div>
                <div>


                </div>

            </div>
        </div>
    </div>
    <div class="row  card pt-4 pb-4">

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">Información</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Cronograma</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                    aria-selected="false">Resultados</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @include('layouts.informacion-evento', ['evento' => $evento])</div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div id="tab2">
                    @php
                        $editable = false;
                    @endphp
                    @livewire('fase-list', ['idEvento' => $evento->id, 'editable' => $editable])
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div id="tab3">
                    <select name="tipo_evento" class="form-control @error('tipo_evento') is-invalid @enderror"
                        id="tipo_evento">
                        <option value="reclutamiento" {{ old('tipo_evento') == 'reclutamiento' ? 'selected' : '' }}>
                            Reclutamiento
                        </option>
                        <option value="competencia_individual"
                            {{ old('tipo_evento') == 'competencia_individual' ? 'selected' : '' }}>
                            Competencia Individual</option>
                        <option value="competencia_grupal"
                            {{ old('tipo_evento') == 'competencia_grupal' ? 'selected' : '' }}>
                            Competencia Grupal(4)</option>
                        <option value="taller_individual"
                            {{ old('tipo_evento') == 'taller_individual' ? 'selected' : '' }}>
                            Taller
                            Individual</option>
                        <option value="taller_grupal" {{ old('tipo_evento') == 'taller_grupal' ? 'selected' : '' }}>
                            Taller
                            Grupal(4)
                        </option>
                    </select>

                </div>
            </div>
        </div>



    </div>
    @if ($evento->auspiciadors->count())
        <div class="row pt-4">
            <div class="card">
                <h5>Auspiciadores</h5>
                <div class="container p-3 ">
                    <div class="row">
                        <div class="col border p-0 ml-3">

                            <div id="contenedorDeImagenAuspiciadores">


                                @foreach ($evento->auspiciadors as $item)
                                    <img src="{{ asset($item->url) }}" alt="logo-banner-{{ $item->nombre }}" />
                                @endforeach

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
