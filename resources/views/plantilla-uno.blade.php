<div>
    <div class="content c1">
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
                                            @if ($evento->tipo_evento=='competencia_individual' || $evento->tipo_evento=='reclutamiento' || $evento->tipo_evento=='taller_individual')
                                                <div class="dropdown" id="lista-registro">
                                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                                        id="dropdownMenuLink boton-registro" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        Ya se encuentra <br>registrado en el evento
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#abandonarModal">Abandonar evento</a>

                                                    </div>
                                                </div>
                                                @include('abandonar-evento', ['evento' => $evento])
                                            @else
                                                <span class="text-center alert alert-success">Grupo: {{$nombreGrupo}}</span>
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
                                                    @if ($evento->tipo_evento=='competencia_individual' || $evento->tipo_evento=='reclutamiento' || $evento->tipo_evento=='taller_individual')
                                                        <form method="POST"
                                                        action="{{ route('registrar-evento-update', ['id' => auth()->user()->id]) }}">
                                                        @method('PUT')
                                                        @csrf

                                                        <input type="hidden" name="evento" value="{{ $evento->id }}">
                                                        <button type="submit" class="btn btn-success" id="boton-registro">
                                                            Registrarse
                                                        </button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('registroEquipo.view', ['evento_id'=>$evento->id]) }}" class="btn btn-success" id="">
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

    <div class="content">
        <div class="tabContainer">
            <ul class="tabs">
                <li>
                    <a src="tab1" href="javascript:void(0);" class="active">Informacion</a>
                </li>
                <li><a src="tab2" href="javascript:void(0);">Publicaciones</a></li>
            </ul>
            <div class="tabContent">
                <div class="c2" id="tab1">
                    <div class="card" id="card-principal">
                        <div class="card" id="detallesEvento">
                            <p class="h4">Detalles</p>
                            <span><i class="bi bi-person h3"></i> Evento de
                                <b>{{ ucfirst(trans($evento->user->name)) }}</b> </span>
                            <span><i class="bi bi-tools h3"></i> Estado: <b
                                    class="{{ $evento->estado }}">{{ $evento->estado }}</b> </span>
                            <span><i class="bi bi-people-fill h3"></i> <span>{{ count($evento->users) }} personas
                                    participan</span></span>

                            @if (!empty($evento->descripcion_evento))
                                <span>Descripción:<p>{{ $evento->descripcion_evento }}</p></span>
                            @endif

                        </div>
                        <div class="card">
                            <h4>Organizador</h4>
                            <div class="row">
                                <div class="col-md-auto">
                                    <img src="{{ $evento->user->foto_perfil }}" class="card-img-top"
                                        alt="imagen no encontrada" style="width:100px; height:100px">
                                </div>
                                <div class="col">
                                    <span>Nombre: <b>{{ ucfirst(trans($evento->user->name)) }}</b></span>

                                    <span>Email: <a
                                            href = "mailto:{{ $evento->user->email }}?subject = Feedback&body = Message"
                                            class="btn btn-link emaillink">
                                            {{ $evento->user->email }}
                                        </a></span>

                                </div>
                            </div>




                        </div>
                        @if ($evento->colaboradors->count())
                            <div class="card">
                                <h4>Colaboradores:</h4>
                                @foreach ($evento->colaboradors as $user)
                                    <div class="row">
                                        <div class="col-md-auto">
                                            <img src="{{ $user->foto_perfil }}" class="card-img-top"
                                                alt="imagen no encontrada" style="width:50px; height:50px">
                                        </div>
                                        <div class="col">
                                            <span>Nombre: <b>{{ ucfirst(trans($user->name)) }}</b></span>

                                            <span>Email: <a
                                                    href = "mailto:{{ $user->email }}?subject = Feedback&body = Message"
                                                    class="btn btn-link emaillink">
                                                    {{ $user->email }}
                                                </a></span>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                    <div class="card" id="participantesContainer">
                        <h5>Ubicacion</h5>
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
        {{-- Auspiciadores --}}
        <div class="content c3">
            <h5>Auspiciadores</h5>
            <div class="container p-3 ">
                <div class="row">
                    <div class="col border p-0 ml-3">

                        <div id="contenedorDeImagenAuspiciadores">

                            @if ($evento->auspiciadors->count())
                                @foreach ($evento->auspiciadors as $item)
                                    <img src="{{ asset($item->url) }}" alt="logo-banner-{{ $item->nombre }}" />
                                @endforeach
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>


        @include('layouts.mensajes-alerta')
    </div>
</div>
