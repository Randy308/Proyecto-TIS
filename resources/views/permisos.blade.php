<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    @include('layouts/estilos')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/roles-script.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/roles-stilos.css') }}">

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="col py-3">
                <div class="container py-5 h-100">
                    <div class="card">
                        <br>
                        <h3 class="d-flex justify-content-center card-title">Asignar permisos</h3>
                        <div class="card-body">
                            <p class="h5">Nombre rol:</p>
                            <p class="form-control">{{  ucfirst(trans($role->name))  }}</p>

                            <p class="h5"><strong>Permisos asigando al rol:</strong></p>
                            @if ($rol_permisos->count())

                                <div id="roles-list" class="d-flex mb-3">
                                </div>
                                @php
                                    $misPermisos = $role->getPermissionNames()->toArray();
                                @endphp

                                <script>
                                    var misPermisos = [];
                                    misPermisos = @json($misPermisos);

                                    for (const iterator of misPermisos) {
                                        agregarPermisos(iterator);
                                    }
                                </script>
                            @else
                                <div class="container">
                                    <div class="row">
                                        <p class="h6">Este rol no cuenta con permisos asignados</p>
                                    </div>
                                </div>
                            @endif





                            <div class="card">
                                <div class="card-body">
                                    <p class="h6">Lista de todos los permisos:</p>
                                    <form action="{{ route('asignarPermiso.update', $role->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @foreach ($permisos as $permiso)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $permiso->name }}" name="name[]"
                                                    @if ($role->getPermissionNames()->contains($permiso->name)) checked @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{ $permiso->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                        <br>
                                        <button type="submit" class="btn btn-primary">Modificar permisos</button>
                                        <input type="button" value="Regresar" class="btn btn-secondary"
                                            onclick="history.back()">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>



    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
</body>

</html>
