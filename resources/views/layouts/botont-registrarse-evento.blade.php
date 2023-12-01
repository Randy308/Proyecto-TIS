<div class="col ">
    <div class="div-btn d-flex justify-content-end">
        @php
            $fechaCompleta = $evento->fecha_inicio . ' ' . $evento->tiempo_inicio;
            $fechaFinal = $evento->fecha_fin . ' ' . $evento->tiempo_fin;

        @endphp
        @if (strtotime($fechaCompleta) >= strtotime(now('GMT-4')))
            @guest
                <button class="btn btn-primary" id="boton-registro" role="button" data-toggle="modal" data-target="#loginModal">
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
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink boton-registro" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
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
                            @if ($evento->modalidad == 'individual')
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalRegistroParticipanteEvento">
                                    Registrarse
                                </button>
                                @include('layouts.modal-registro-evento')
                            @else
                                @if (auth()->user()->can('coach.registrar-equipo'))
                                    <a href="{{ route('registroEquipo.view', ['evento_id' => $evento->id]) }}"
                                        class="btn btn-success" id="">
                                        Registar Equipo
                                    </a>
                                @else
                                    <button type="button" disabled class="btn btn-info btn-sm" id="boton-registro">
                                        Registro disponible <br> para entrenadores
                                    </button>
                                @endif
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
                        <a class="btn btn-secondary" href="{{ route('fases.fasesdeEvento', ['evento' => $evento->id]) }}">
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
