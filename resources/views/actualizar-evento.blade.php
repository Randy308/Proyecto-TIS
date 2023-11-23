<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Evento</title>
    @include('layouts/estilos')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ubicacionevento.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')


            <div class="contenedor-flex">

                <div class="container contact-form">


                    <div class="contact-image">
                        <span><i class="bi bi-calendar2-plus-fill"></i></span>
                    </div>
                    <form method="POST"
                        action="{{ route('evento.update', ['user' => auth()->user()->id, 'evento' => $miEvento->id]) }}">
                        @csrf
                        @method('PUT')
                        <h2>Modificar Evento</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_evento">Nombre del Evento</label>
                                    <input type="text" name="nombre_evento"
                                        class="form-control @error('nombre_evento') is-invalid @enderror"
                                        id="nombre_evento" value="{{ $miEvento->nombre_evento }}"
                                        placeholder="Ingrese el nombre del evento" required
                                        aria-describedby="nombre_evento_help">
                                    @error('nombre_evento')
                                        <span id="nombre_evento_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Ubicacion">Agregar ubicación:</label>
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#exampleModal"> <i class="bi bi-geo-alt-fill"></i></button>
                                    @include('layouts.modal-editar-ubicacion')
                                </div>

                                <div class="form-group">
                                    <label for="tipo_evento">Tipo de Evento</label>
                                    <select name="tipo_evento" class="form-control" id="tipo_evento" required>
                                        @foreach ($tiposEvento as $tipo)
                                            <option value="{{ $tipo }}" {{ $miEvento->tipo_evento === $tipo ? 'selected' : '' }}>
                                                {{ $tipo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="privacidad">Privacidad</label>
                                    <select name="privacidad" class="form-control" id="privacidad" required>
                                        @foreach ($privacidades as $privacidad)
                                            <option value="{{ $privacidad }}" {{ $miEvento->privacidad_evento === $privacidad ? 'selected' : '' }}>
                                                {{ $privacidad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="inscritos_minimos">Inscritos Mínimos</label>
                                    <input type="number" name="inscritos_minimos" class="form-control" id="inscritos_minimos" value="{{ $miEvento->min_inscritos }}" min="0" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="inscritos_maximos">Inscritos Máximos</label>
                                    <input type="number" name="inscritos_maximos" class="form-control" id="inscritos_maximos" value="{{ $miEvento->max_inscritos }}" min="{{ $miEvento->min_inscritos }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de inicio</label>
                                    <input type="date" name="fecha_inicio"
                                        class="form-control @error('fecha_inicio') is-invalid @enderror"
                                        id="fecha_inicio" value="{{ $miEvento->fecha_inicio }}" required
                                        aria-describedby="fecha_inicio_help">
                                    @error('fecha_inicio')
                                        <span id="fecha_inicio_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="fecha_fin">Fecha de finalización</label>
                                    <input type="date" name="fecha_fin"
                                        class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin"
                                        value="{{ $miEvento->fecha_fin }}" required aria-describedby="fecha_fin_help">
                                    @error('fecha_fin')
                                        <span id="fecha_fin_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion_evento">Descripcion del Evento</label>
                                    <textarea type="text" name="descripcion_evento"
                                        class="form-control @error('descripcion_evento') is-invalid @enderror" id="descripcion_evento" required
                                        aria-describedby="descripcion_evento_help" placeholder="Ingrese la descripcion del evento"
                                        style="width: 100%; height: 300px;">{{ $miEvento->descripcion_evento }}</textarea>
                                    @error('descripcion_evento')
                                        <span id="descripcion_evento_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group text-center botones-juntos">
                                    <a href="#" class="btn btn-cancelar" style="width: 45%;"
                                        onclick="confirmarCancelacion()">Cancelar</a>
                                    <button type="submit" class="btn btn-info" style="width: 45%;">Actualizar
                                        Evento</button>
                                </div>

                            </div>
                        </div>



                        <script>
                            function confirmarCancelacion() {
                                if (confirm("¿Estás seguro de que deseas salir? Todos los cambios no guardados se perderán.")) {
                                    window.location.href = "{{ route('misEventos') }}";
                                }
                            }
                        </script>

                    </form>
                </div>

            </div>


        </div>
    </div>

    @include('layouts/sidebar-scripts')
    <script>
        $(function() {
            const date = new Date();

            let day = date.getDate();
            if (day < 10) {
                day = '0' + day;
            }
            let month = date.getMonth() + 1;
            if (month < 10) {
                month = '0' + month;
            }
            let year = date.getFullYear();

            // This arrangement can be altered based on how we want the date's format to appear.
            let currentDate = `${year}-${month}-${day}`;
            document.getElementById('fecha_inicio').setAttribute('min', currentDate);
            document.getElementById('fecha_fin').setAttribute('min', currentDate);
        });
    </script>
    @include('layouts.mensajes-alerta')
    <script src="{{ asset('js/ubicacionYauspiciador.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHfE5-hGkrVMcsw7p6rA4AQR-r1WU3tZY&libraries=places&callback=iniciarMapa">
    </script>
</body>

</html>
