<div class="content c1">
    <div class="card">
        <div class="contenedor-banner position-relative">
            <div id="fondotransparente"></div>
            <button id="mostrarMap" class="btn btn-success position-absolute"><span>Ubicacion</span></button>
            <div id="contenedormap" class="position-absolute p-5">
                <h3 class="mt-2 ">Ubicacion del Evento</h3>
                <div class="row">
                    <div class="col-4 mt-5">
                        <div class="mb-4 mt-2">
                            <label for="latitud" class="form-label">Latitud</label>
                            <input type="text" class="form-control" id="latitud">
                        </div>
                        <div class="mb-4">
                            <label for="longitud" class="form-label">Longitud</label>
                            <input type="text" class="form-control" id="longitud">
                        </div>
                        <button id="cargarcoordenadas" class="btn btn-success" type="button">Cargar</button>
                    </div>
                    <div class="col-8 px-3 py-2 pl-5">
                        <div id="mapa"></div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button id="adiosMap" type="button" class="btn btn-secondar mr-5">Cerrar</button>
                    <button type="button" class="btn btn-primary ml-5">Guardar</button>
                </div>
            </div>
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

                                            @if (auth()->check())
                                                @if (auth()->user()->id === 1)
                                                    <td>
                                                        <button class="btn btn-danger" data-toggle="modal"
                                                            data-target="#eliminarParticipanteModal">Eliminar</button>
                                                    </td>
                                                @endif
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
            <form action="{{route('guardarAuspiciador')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="url" id="" accept="image/*">
                    @error('url')
                        <small class="text-danger">{{$message}}</small>
                    @enderror    
                </div>
                <button type="submit" class="btn btn-primary">Subir Imagen</button>
            </form>
        </div>
    </div>
</div>
