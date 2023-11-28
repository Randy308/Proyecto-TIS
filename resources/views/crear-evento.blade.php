<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Evento</title>
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
                    <form method="POST" action="{{ route('crear-evento') }}" id="FormCrearEvento">
                        @csrf
                        <h2>Crear Evento</h2>
                        @php
                            $misValores = session()->getOldInput();
                            $miAuspiciadores = isset($misValores['Auspiciadores']) ? $misValores['Auspiciadores'] : [];
                        @endphp
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_evento">Nombre del Evento <span
                                            class="text-danger font-weight-bold ">*</span></label>
                                    <input type="text" name="nombre_evento"
                                        class="form-control @error('nombre_evento') is-invalid @enderror"
                                        id="nombre_evento" value="{{ old('nombre_evento') }}"
                                        placeholder="Ingrese el nombre del evento" required
                                        aria-describedby="nombre_evento_help">
                                    @error('nombre_evento')
                                        <span id="nombre_evento_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="alert alert-danger" role="alert" id="nombreEventoCheck">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_evento">Tipo de Evento</label>
                                    <select name="tipo_evento"
                                        class="form-control @error('tipo_evento') is-invalid @enderror"
                                        id="tipo_evento">
                                        <option value="reclutamiento"
                                            {{ old('tipo_evento') == 'reclutamiento' ? 'selected' : '' }}>Reclutamiento
                                        </option>
                                        <option value="competencia_individual"
                                            {{ old('tipo_evento') == 'competencia_individual' ? 'selected' : '' }}>
                                            Competencia Individual</option>
                                        <option value="competencia_grupal"
                                            {{ old('tipo_evento') == 'competencia_grupal' ? 'selected' : '' }}>
                                            Competencia Grupal(4)</option>
                                        <option value="taller_individual"
                                            {{ old('tipo_evento') == 'taller_individual' ? 'selected' : '' }}>Taller
                                            Individual</option>
                                        <option value="taller_grupal"
                                            {{ old('tipo_evento') == 'taller_grupal' ? 'selected' : '' }}>Taller Grupal(4)
                                        </option>
                                    </select>
                                    @error('tipo_evento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                
                                

                                <div class="form-group">
                                    <label for="Ubicacion">Agregar ubicación:</label>
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#exampleModal"> <i class="bi bi-geo-alt-fill"></i></button>
                                    @include('modal-ubicacion')
                                </div>

                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de inicio <span
                                            class="text-danger font-weight-bold ">*</span></label>
                                    <input type="datetime-local" name="fecha_inicio"
                                        class="form-control @error('fecha_inicio') is-invalid @enderror"
                                        id="fecha_inicio" value="{{ old('fecha_inicio') }}" required
                                        aria-describedby="fecha_inicio_help">
                                    @error('fecha_inicio')
                                        <span id="fecha_inicio_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="fecha_fin">Fecha de finalización <span
                                            class="text-danger font-weight-bold ">*</span></label>
                                    <input type="datetime-local" name="fecha_fin"
                                        class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin"
                                        value="{{ old('fecha_fin') }}" required aria-describedby="fecha_fin_help">
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
                                        class="form-control @error('descripcion_evento') is-invalid @enderror" id="descripcion_evento"
                                        aria-describedby="descripcion_evento_help" placeholder="Ingrese la descripcion del evento"
                                        style="width: 100%; max-height: 190px;height: 180px;">{{ old('descripcion_evento') }}</textarea>
                                    @error('descripcion_evento')
                                        <span id="descripcion_evento_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="alert alert-danger" role="alert" id="descripcionEventoCheck">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="privacidad">Privacidad del Evento</label>
                                    <select name="privacidad"
                                        class="form-control @error('privacidad') is-invalid @enderror" id="privacidad"
                                        required>
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
                                    <div>
                                        @livewire('eventos-dropdown')
                                    </div>




                                </div>

                            </div>
                            <div class="col d-flex"> <span class="text-danger font-weight-bold ">* Indica que el campo
                                    es obligatorio</span></div>
                            <div class="col d-flex justify-content-end">
                                <div class="form-group">
                                    <a href="#" class="btn btn-cancelar"
                                        onclick="confirmarCancelacion()">Cancelar</a>
                                    <button type="submit" class="btn btn-info" id="crearEventoBoton">Crear Evento</button>
                                </div>
                            </div>
                        </div>



                        <script>
                            function confirmarCancelacion() {
                                if (confirm("¿Estás seguro de que deseas cancelar el evento?")) {
                                    window.location.href = "{{ route('index') }}";
                                }
                            }
                        </script>
                    </form>
                </div>

                <input type="hidden" value="{{ old('Auspiciadores[]') }}">

            </div>


        </div>
    </div>

    @include('layouts/sidebar-scripts')
    <script src="{{ asset('js/validaciones-formulario.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>


    <script src="{{ asset('js/ubicacionYauspiciador.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHfE5-hGkrVMcsw7p6rA4AQR-r1WU3tZY&libraries=places&callback=iniciarMapa">
    </script>
    <script src="{{ asset('js/script-fecha.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Oculta los campos adicionales al cargar la página
            $('#campos-adicionales input[type="text"]').hide();

            // Muestra u oculta los campos adicionales según el estado de los checkboxes
            $('input[type="checkbox"]').change(function() {
                var campoAsociado = $(this).next('input[type="text"]');
                campoAsociado.toggle(); // Muestra u oculta el campo según el estado del checkbox
            });

            // Muestra u oculta los campos adicionales al cambiar la opción en el menú desplegable
            $('#privacidad').change(function() {
                if ($(this).val() === 'con-restriccion') {
                    $('#campos-adicionales').show();
                } else {
                    $('#campos-adicionales').hide();
                    // Oculta los campos adicionales si el tipo de evento no es "competencia_individual" ni "taller_individual"
                    $('#eventoRequeridoGroup').hide();
                    $('#mostrarEvento').prop('checked', false);
                    $('#evento').hide();
                }
            });

            $('#tipo_evento').change(function() {
                var selectedTipoEvento = $(this).val();
                var eventoRequeridoGroup = $('#eventoRequeridoGroup');

                if (selectedTipoEvento === 'competencia_individual' || selectedTipoEvento ===
                    'competencia_grupal') {
                    eventoRequeridoGroup.show();
                } else {
                    camposAdicionales.hide();
                    eventoRequeridoGroup.hide();
                    $('#mostrarEvento').prop('checked', false);
                    $('#evento').hide();
                }
            });

            $('#mostrarEvento').change(function() {
                $('#evento').toggle(this.checked);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#campos-adicionales').hide();
            $('#privacidad').change(function() {
                if ($(this).val() === 'con-restriccion') {
                    $('#campos-adicionales').show();
                } else {
                    $('#campos-adicionales').hide();
                }
            });
        });
    </script>

    <script>

        function confirmarCancelacion() {
            if (confirm("¿Estás seguro de que deseas cancelar el evento?")) {
                window.location.href = "{{ route('index') }}";
            }
        }
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

    @include('layouts.mensajes-alerta')
    @livewireScripts
</body>

</html>
