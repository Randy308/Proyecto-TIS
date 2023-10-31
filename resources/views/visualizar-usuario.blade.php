

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

            @include('layouts/navbar')
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center display-4">Detalle del Usuario</div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{$usuario->direccion_foto}}" class="img-fluid" alt="Imagen de Perfil">
                                </div>
                      

                                <ul class="list-group mt-3">
                                    <li class="list-group-item"><strong>Rol:</strong> {{ $usuario->rol->nombre_rol }}</li>
                                    <li class="list-group-item"><strong>Estado:</strong> <span class="{{ $usuario->estado == 'Habilitado' ? 'text-success' : 'text-danger' }}">{{ $usuario->estado }}</span></li>
                                    
                                </ul>

                                <ul class="list-group mt-3">
                                    <li class="list-group-item"><strong>Nombre:</strong> {{ $usuario->name }}</li>
                                    <li class="list-group-item"><strong>Correo Electrónico:</strong> {{ $usuario->email }}</li>
                                    <li class="list-group-item"><strong>Teléfono:</strong> {{ $usuario->telefono }}</li>
                                    <li class="list-group-item"><strong>Dirección:</strong> {{ $usuario->direccion }}</li>
                                    <li class="list-group-item"><strong>Instituto:</strong> {{ $usuario->instituto }}</li>
                                    <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> {{ $usuario->fecha_nac }}</li>
                                </ul>

                                <div class="text-center mt-4">
                                    <a href="{{ route('listaUsuarios') }}" class="btn btn-danger mr-2">Volver</a>
                                    <a href="#" class="btn btn-primary">Editar</a>
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


