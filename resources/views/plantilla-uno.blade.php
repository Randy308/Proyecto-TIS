<div class="content c1">
    <div class="card">
        <div class="contenedor-banner">
            <img src="{{ asset($evento->direccion_banner) }}" alt="logo-banner" id="miBanner" />
        </div>
        <div class="div-titulo">
            <div>
                @php

                    $idEventoPagina = $evento->id;

                    \Carbon\Carbon::setLocale('es');
                @endphp
                <h5>Fecha {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d-m-Y \a \l\a\s H:i:s') }}</h5>


                <h1 id="miTitulo">{{ $evento->nombre_evento }}</h1>
                <h6>Tipo de evento: <b> {{ $evento->categoria }}</b></h6>
            </div>
            <div class="div-btn-registrarse">
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
                        <h4>Ya se encuentra registrado en el evento</h4>
                    @else
                        <form method="POST" action="{{ route('registrar-evento-update', ['id' => auth()->user()->id]) }}">
                            @method('PUT')
                            @csrf

                            <input type="hidden" name="evento" value="{{ $evento->id }}">
                            <button type="submit" class="btn btn-primary" id="boton-registro">
                                Registrarse
                            </button>
                        </form>
                    @endif



                @endauth
            </div>
        </div>
    </div>
</div>

<div id="content" class="content">
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
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evento->users as $user)
                                        <tr>

                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>


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
                <div class="card">
                    <span><b>usuario: </b>mensaje 1 ...</span>
                </div>
                <div class="card">
                    <span><b>usuario: </b>mensaje 2 ...</span>
                </div>
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
