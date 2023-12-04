<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario</title>
    @include('layouts/estilos')

    <link rel="stylesheet" href="{{ asset('css/plantilla-uno.css') }}" />
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts.mensajes-alerta')
            @include('layouts/navbar')
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center h5">Detalle del Usuario</div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ $usuario->foto_perfil }}"
                                        onerror="this.onerror=null; this.src='/storage/image/default_user_image.png'"
                                        class="img-fluid" alt="Imagen de Perfil" style="width:200px; height:200px">
                                </div>


                                <ul class="list-group mt-3">
                                    <li class="list-group-item"><strong>Rol:</strong>
                                        @foreach ($usuario->getRoleNames() as $item)
                                            {{ ucfirst(trans($item)) }}
                                            @if (!$loop->last)
                                                ,
                                            @else
                                                .
                                            @endif
                                        @endforeach

                                    </li>
                                    <li class="list-group-item"><strong>Estado:</strong> <span
                                            class="{{ $usuario->estado == 'Habilitado' ? 'text-success' : 'text-danger' }}">{{ $usuario->estado }}</span>
                                    </li>

                                </ul>

                                <ul class="list-group mt-3">
                                    <li class="list-group-item"><strong>Nombre:</strong> {{ $usuario->name }}</li>
                                    <li class="list-group-item"><strong>Correo Electrónico:</strong>
                                        {{ $usuario->email }}</li>
                                    <li class="list-group-item"><strong>Teléfono:</strong> {{ $usuario->telefono }}</li>
                                    <li class="list-group-item"><strong>Dirección:</strong> {{ $usuario->direccion }}
                                    </li>
                                    <li class="list-group-item"><strong>Instituto:</strong> {{ $institucion }}</li>
                                    <li class="list-group-item"><strong>Fecha de Nacimiento:</strong>
                                        {{ $usuario->fecha_nac }}</li>
                                    <li class="list-group-item"><strong>Historial Academico:</strong>
                                        {{ $usuario->historial_academico }}</li>
                                </ul>

                                <div class="text-center mt-4">

                                    <button onclick="history.back()" type="submit" class="btn btn-danger mr-2">Volver</button>
                                    <a href="{{ route('editarUsuario', $usuario->id) }}"
                                        class="btn btn-primary">Editar</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    @include('layouts/sidebar-scripts')
</body>

</html>
