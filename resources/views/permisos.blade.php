<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    @include('layouts/estilos')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                            <p class="form-control">{{ $role->name }}</p>

                            <p class="h6">Permisos asigando al rol:</p>
                            @if ($rol_permisos->count())
                                <div class="container">
                                    <div class="row">
                                        @foreach ($rol_permisos as $rol_permiso)
                                            <div class="form-check col-12 col-md-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $rol_permiso->id }}" id="flexCheckChecked" checked
                                                    disabled>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    {{ $rol_permiso->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="container">
                                    <div class="row">
                                        <p><strong>Este rol no cuenta con permisos asignados</strong></p>
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
                                                    value="{{ $permiso->name }}" name="name[]">
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
