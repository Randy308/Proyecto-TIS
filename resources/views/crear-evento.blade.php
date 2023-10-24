<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Evento</title>
    @include('layouts/estilos')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')


            <div class="contenedor-flex mt-5">
                <div class="formulario">
                    <div class="container">
                        <h1>Crear Evento</h1>

                        <form method="POST" action="{{ route('crear-evento') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nombre_evento">Nombre del Evento</label>
                                <input type="text" name="nombre_evento" class="form-control @error('nombre_evento') is-invalid @enderror" id="nombre_evento" value="{{ old('nombre_evento') }}" required aria-describedby="nombre_evento_help">
                                @error('nombre_evento')
                                    <span id="nombre_evento_help" class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="descripcion_evento">Descripcion del Evento</label>
                                <input type="text" name="descripcion_evento" class="form-control @error('descripcion_evento') is-invalid @enderror" id="descripcion_evento" value="{{ old('descripcion_evento') }}" required aria-describedby="descripcion_evento_help">
                                @error('descripcion_evento')
                                    <span id="descripcion_evento_help" class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            

                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <select name="categoria" class="form-control" id="categoria" required>
                                    <option value="Diseño">Diseño</option>
                                    <option value="QA">QA</option>
                                    <option value="Desarrollo">Desarrollo</option>
                                    <option value="Ciencia de datos">Ciencia de datos</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de inicio</label>
                                <input type="date" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" value="{{ old('fecha_inicio') }}" required aria-describedby="fecha_inicio_help">
                                @error('fecha_inicio')
                                    <span id="fecha_inicio_help" class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="fecha_fin">Fecha de finalización</label>
                                <input type="date" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" value="{{ old('fecha_fin') }}" required aria-describedby="fecha_fin_help">
                                @error('fecha_fin')
                                    <span id="fecha_fin_help" class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <script>
                                function confirmarCancelacion() {
                                    if (confirm("¿Estás seguro de que deseas cancelar el evento?")) {
                                        window.location.href = "{{ route('index') }}";
                                    }
                                }
                            </script>
                            <div class="form-group text-center botones-juntos">
                                <a href="#" class="btn btn-cancelar" style="width: 45%;"
                                    onclick="confirmarCancelacion()">Cancelar</a>
                                <button type="submit" class="btn btn-info" style="width: 45%;">Crear Evento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

    @include('layouts/sidebar-scripts')
</body>

</html>
