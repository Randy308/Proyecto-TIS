<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Evento</title>
    @include('layouts/estilos')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
        integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/ubicacionevento.css') }}">
</head>

<body>
    @livewireStyles
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
                        action="{{ route('evento.update', ['user' => auth()->user()->id, 'evento' => $miEvento->id]) }}"
                        id="FormCrearEvento">
                        @csrf
                        @method('PUT')
                        <h2>Modificar Evento</h2>
                        @php
                            $misAuspiciadores = isset($miEvento->auspiciadors) ? $miEvento->auspiciadors : [];
                            $miAuspiciadores = [];

                            foreach ($misAuspiciadores as $auspiciador) {
                                $miAuspiciadores[] = $auspiciador->nombre;
                            }
                        @endphp

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
                                    <label for="tipo_evento">Tipo de Evento</label>
                                    <select name="tipo_evento" class="form-control" id="tipo_evento" required>
                                        @foreach ($tiposEvento as $tipo)
                                            <option value="{{ $tipo }}"
                                                {{ $miEvento->tipo_evento === $tipo ? 'selected' : '' }}>
                                                {{ $tipo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="privacidad">Privacidad</label>
                                    <select name="privacidad" class="form-control" id="privacidad" required>
                                        @foreach ($privacidades as $privacidad)
                                            <option value="{{ $privacidad }}"
                                                {{ $miEvento->privacidad_evento === $privacidad ? 'selected' : '' }}>
                                                {{ $privacidad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group pb-4">
                                    <div class="row">
                                        <div class="col">
                                            <label for="inscritos_minimos">Inscritos Mínimos</label>
                                            <input type="number" name="inscritos_minimos" class="form-control"
                                                id="inscritos_minimos" value="{{ $miEvento->min_inscritos }}" min="0"
                                                required>
                                        </div>
                                        <div class="col">
                                            <label for="inscritos_maximos">Inscritos Máximos</label>
                                            <input type="number" name="inscritos_maximos" class="form-control"
                                                id="inscritos_maximos" value="{{ $miEvento->max_inscritos }}"
                                                min="{{ $miEvento->min_inscritos }}" required>
                                        </div>
                                    </div>

                                </div>

 
                            
                               


                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de inicio</label>
                                    <input type="datetime-local" name="fecha_inicio"
                                        class="form-control @error('fecha_inicio') is-invalid @enderror"
                                        id="fecha_inicio" value="{{ $miEvento->fecha_inicio }} {{$miEvento->tiempo_inicio}}" required
                                        aria-describedby="fecha_inicio_help" readonly>
                                    @error('fecha_inicio')
                                        <span id="fecha_inicio_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="fecha_fin">Fecha de finalización</label>
                                    <input type="datetime-local" name="fecha_fin"
                                        class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin"
                                        value="{{ $miEvento->fecha_fin }} {{$miEvento->tiempo_fin}}" required aria-describedby="fecha_fin_help"
                                        readonly>
                                    @error('fecha_fin')
                                        <span id="fecha_fin_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="auspiciadoresSelect">Seleccione Auspiciadores: </label>
                                    <select id="auspiciadoresSelect" class="form-select"
                                        aria-label="Default select example">
                                        <option selected disabled>Lista de auspiciadores</option>

                                        @if ($auspiciadores)
                                            @foreach ($auspiciadores as $auspiciador)
                                                <option value="{{ $auspiciador->nombre }}">{{ $auspiciador->nombre }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option selected disabled>No existen auspiciadores</option>

                                        @endif
                                    </select>
                                    <div id="recipient-list" class="d-flex">

                                    </div>
                                </div>
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

                                <div class="form-group">
                                    <label for="privacidad">Privacidad del Evento</label>
                                    <select name="privacidad" class="form-control @error('privacidad') is-invalid @enderror" id="privacidad" required>
                                        <option value="libre">Libre</option>
                                        <option value="con-restriccion">Con Restriccion</option>
                                    </select>
                                    @error('privacidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div id="campos-adicionales">
                                    
                                    <div class="form-group">
                                        <input type="checkbox" name="mostrarCosto" id="mostrarCosto"> Costo del Evento
                                        <input type="text" name="costo" class="form-control @error('costo') is-invalid @enderror" id="costo" placeholder="Ingrese el costo del evento" value="{{ old('costo') }}">
                                        @error('costo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <input type="checkbox" name="mostrarCantidadMinima" id="mostrarCantidadMinima"> Cantidad mínima de participantes
                                        <input type="text" name="cantidad_minima" class="form-control @error('cantidad_minima') is-invalid @enderror" id="cantidad_minima" placeholder="Ingrese la cantidad mínima de participantes" value="{{ old('cantidad_minima') }}">
                                        @error('cantidad_minima')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <input type="checkbox" name="mostrarCantidadMaxima" id="mostrarCantidadMaxima"> Cantidad máxima de participantes
                                        <input type="text" name="cantidad_maxima" class="form-control @error('cantidad_maxima') is-invalid @enderror" id="cantidad_maxima" placeholder="Ingrese la cantidad máxima de participantes" value="{{ old('cantidad_maxima') }}">
                                        @error('cantidad_maxima')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
{{--                                     <div>
                                        @livewire('eventos-dropdown')
                                        </div> --}}




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
            <div class="container contact-form">
                <br>
                <div class="row">
                    <div class="col-md-6 text-center text-md-left">
                        <H3>Gestion de fases</H3>
                    </div>
                    <div class="col-md-6 text-center text-md-right">
                        <a class="btn btn-primary" href="#" role="button" data-toggle="modal"
                            data-target="#fasesModal">
                            Crear una fase
                        </a>
                    </div>
                </div>
                @livewire('fase-list', ['idEvento' => $miEvento->id])

            </div>

        </div>
    </div>

    @include('fasesForm', ['evento' => $miEvento])

    @include('layouts/sidebar-scripts')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Oculta los campos adicionales al cargar la página
            $('#campos-adicionales input[type="text"]').hide();

            // Muestra u oculta los campos adicionales según el estado de los checkboxes
            $('input[type="checkbox"]').change(function () {
                var campoAsociado = $(this).next('input[type="text"]');
                campoAsociado.toggle(); // Muestra u oculta el campo según el estado del checkbox
            });

            // Muestra u oculta los campos adicionales al cambiar la opción en el menú desplegable de privacidad
            $('#privacidad').change(function () {
                var privacidadSeleccionada = $(this).val();
                var camposAdicionales = $('#campos-adicionales');
                var eventoRequeridoGroup = $('#eventoRequeridoGroup');

                if (privacidadSeleccionada === 'con-restriccion') {
                    camposAdicionales.show();
                } else {
                    camposAdicionales.hide();
                    eventoRequeridoGroup.hide();
                    $('#mostrarEvento').prop('checked', false);
                    $('#evento').hide();
                }
            });

        });
    </script>
    <script>
        
        $(document).ready(function () {
            $('#campos-adicionales').hide();
            $('#privacidad').change(function () {
                if ($(this).val() === 'con-restriccion') {
                    $('#campos-adicionales').show();
                } else {
                    $('#campos-adicionales').hide();
                }
            });
        });
    </script>
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
    <script src="{{ asset('js/script-crear-evento.js') }}"></script>
    <script>
        // Convierte el array de auspiciadores de PHP a un array de JavaScript
        var auspiciadoresArray = @json($miAuspiciadores);
        for (const iterator of auspiciadoresArray) {
            addRecipient(iterator);
        }
        // Puedes usar auspiciadoresArray en tu código JavaScript
        console.log(auspiciadoresArray);
    </script>
</body>

</html>
