<div class="col ">
    <div class="div-btn d-flex justify-content-end">
        @php
            $fechaCompleta = $evento->fecha_inicio . ' ' . $evento->tiempo_inicio;
            $fechaFinal = $evento->fecha_fin . ' ' . $evento->tiempo_fin;

        @endphp
        @if (strtotime($fechaCompleta) >= strtotime(now('GMT-4')))
            @guest
                <button class="btn btn-sm btn-primary" id="boton-registro" role="button" data-toggle="modal"
                    data-target="#loginModal">
                    Iniciar Sesion
                </button>

            @endguest
            @auth
                @if (auth()->user()->hasRole('usuario común') ||
                        auth()->user()->hasRole('coach'))
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
                        @if ($evento->modalidad == 'individual')
                            <div class="dropdown" id="lista-registro">
                                @php
                                    if ($evento->privacidad == 'libre') {
                                        $message = 'Ya se encuentra';
                                        $message2 = 'registrado en el evento';
                                    } else {
                                        $message = 'Solicitud enviada';
                                        $message2 = ' ';
                                    }
                                @endphp
                                <a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink boton-registro" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{ $message }}<br>{{ $message2 }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#abandonarModal">Abandonar evento</a>

                                </div>
                            </div>
                            @include('abandonar-evento', ['evento' => $evento])
                        @else
                            @php
                                if ($evento->privacidad == 'libre') {
                                    $message = 'registrado en el evento';
                                } else {
                                    $message = 'Solicitud enviada';
                                }
                            @endphp
                            @if (auth()->user()->can('coach.registrar-equipo'))
                                <a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink boton-registro" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Grupo:{{ $nombreGrupo . ',' }} <br>{{ $message }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <button type="button" class="dropdown-item" data-toggle="modal"
                                        data-target="#modalEliminarGrupo">
                                        Abandonar evento
                                    </button>

                                </div>
                                @include('layouts.modal-eliminar-grupo', [
                                    'evento' => $evento,
                                    'grupo_id' => $grupo->id,
                                ])
                            @else
                                <button disabled class="btn btn-success btn-sm"> Grupo:{{ $nombreGrupo . ',' }}
                                    <br>{{ $message }}</button>
                            @endif
                        @endif
                    @else
                        @if (strtoupper($evento->estado) == 'CANCELADO')
                            <button type="button" disabled class="btn btn-sm btn-danger" id="boton-registro">
                                Evento cancelado
                            </button>
                        @elseif(strtoupper($evento->estado) == 'FINALIZADO')
                            <button type="button" disabled class="btn btn-sm btn-primary" id="boton-registro">
                                Evento finalizado
                            </button>
                        @elseif (strtoupper($evento->estado) == 'ACTIVO')
                            @if ($evento->modalidad == 'individual')
                                @if (auth()->user()->hasRole('usuario común'))
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#modalRegistroParticipanteEvento">
                                        Registrarse
                                    </button>
                                    @include('layouts.modal-registro-evento')
                                @else
                                    <button disabled class="btn btn-warning btn-sm"> Registro unicamente <br> para
                                        participantes</button>
                                @endif
                            @else
                                @if (auth()->user()->can('coach.registrar-equipo'))
                                    <a href="{{ route('registroEquipo.view', ['evento_id' => $evento->id]) }}"
                                        class="btn btn-sm btn-sm btn-success" id="">
                                        Registra tu equipo
                                    </a>
                                @else
                                    <button disabled class="btn btn-warning btn-sm"> Registro unicamente <br> para
                                        entrenadores</button>
                                @endif
                            @endif
                        @else
                            <button type="button" disabled class="btn btn-sm btn-info" id="boton-registro">
                                Registro no disponible
                            </button>
                        @endif
                    @endif
                @else
                    <button type="button" disabled class="btn btn-sm btn-info" id="boton-registro">
                        Inscripción solo para<br>participantes y entrenadores.
                    </button>
                @endif




            @endauth
        @elseif (strtotime($fechaFinal) >= strtotime(now('GMT-4')))
            @guest
                <button type="button" disabled class="btn btn-sm btn-primary" id="boton-registro">
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
                        <button type="button" class="btn btn-sm btn-info" disabled> Ya esta <br>registrado
                            en el evento</button>

                    </div>
                @else
                    <button type="button" disabled class="btn btn-sm btn-primary" id="boton-registro">
                        Evento en progreso <br>no se admiten mas incripciones
                    </button>
                @endif
            @endauth
        @else
            <button type="button" disabled class="btn btn-sm btn-primary" id="boton-registro">
                Evento finalizado
            </button>

        @endif


    </div>
</div>
