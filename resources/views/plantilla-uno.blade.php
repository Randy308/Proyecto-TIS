<div class="content c1">
    <div class="card">
        <div class="contenedor-banner">
            <img src="{{ asset($evento->direccion_banner) }}" alt="logo-banner" id="miBanner" />
        </div>
        <div class="div-titulo">
            <div>
                @php

                    $idEventoPagina = $evento->id;

                    \Carbon\Carbon::setlocale(config('app.locale'));
                @endphp
                <h5>Fecha {{ \Carbon\Carbon::parse($evento->fecha_fin)->formatLocalized('%d %b %Y') }}</h5>


                <h1 id="miTitulo">{{ $evento->nombre_evento }}</h1>
                <h6>Tipo de evento: <b> {{ $evento->categoria }}</b></h6>
            </div>
            <div class="div-btn-registrarse">
                @if (strtotime($evento->fecha_fin) > strtotime(now()))
                    @guest
                        <button class="btn btn-primary" id="boton-registro" role="button" data-toggle="modal"
                            data-target="#loginModal">
                            Iniciar Sesion
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
                            <form method="POST"
                                action="{{ route('registrar-evento-update', ['id' => auth()->user()->id]) }}">
                                @method('PUT')
                                @csrf

                                <input type="hidden" name="evento" value="{{ $evento->id }}">
                                <button type="submit" class="btn btn-primary" id="boton-registro">
                                    Registrarse
                                </button>
                            </form>
                        @endif



                    @endauth
                @else
                    <p>El evento ya paso.</p>
                @endif


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
                    <div class="card">
                        <h4>Detalles</h4>
                        <p>descripcion</p>
                        <p>{{ $evento->descripcion_evento }}</p>
                        <h5>Estado</h5>
                        <p>{{ $evento->estado }}</p>
                    </div>
                    <div class="card">
                        <h4>Organizador</h4>
                        <p>{{ $evento->user->name }}</p>
                        <p>{{ $evento->user->email }}</p>


                    </div>
                    <div class="card"></div>
                </div>
                <div class="card" id="participantesContainer">
                    <h5>Lista de Participantes</h5>
                    <div class="card" id="participantes">



                        @if ($evento->users->count())
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($evento->users as $user)
                                        <tr>

                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            @include('eliminar-participante')

                                            @if (auth()->check() && (auth()->user()->hasRole('administrador') || auth()->user()->hasRole('organizador')))
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#eliminarParticipanteModal_{{ $user->id }}">Eliminar</button>
                                            </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No existe participantes</p>
                        @endif


                    </div>
                </div>
            </div>
            <div class="card" id="tab2">

            </div>
        </div>
    </div>
</div>
<div class="content c3">
    <div class="card">
        <div>
            <h5>Auspiciadores</h5>

        </div>
    </div>
</div>
@include('layouts.mensajes-alerta')

