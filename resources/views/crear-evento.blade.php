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
                        <div class="row py-4">
                            <div class="col-md">
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
                                <div class="form-group py-4">
                                    <label for="tipo_evento">Tipo de Evento<span
                                            class="text-danger font-weight-bold ">*</span></label>
                                    <div class="row">
                                        <div class="col-md-auto py-2">
                                            <select id="selectorTipo"
                                                class="form-control @error('tipo_evento') is-invalid @enderror">
                                                <option value="Reclutamiento">
                                                    Reclutamiento
                                                </option>
                                                <option value="Competencia">
                                                    Competencia</option>
                                                <option value="Taller">
                                                    Taller</option>
                                                <option value="Otro">
                                                    Otro</option>

                                            </select>
                                        </div>
                                        <div class="col-md-auto">
                                            <input type="text" name="tipo_evento"
                                                class="form-control @error('tipo_evento') is-invalid @enderror"
                                                id="tipo_evento" value="{{ old('tipo_evento', 'Reclutamiento') }}"
                                                placeholder="Ingrese el tipo de evento" required
                                                aria-describedby="tipo_evento_help">
                                            @error('tipo_evento')
                                                
                                            @enderror
                                            <div class="alert alert-danger" role="alert" id="tipo_eventoCheck">

                                            </div>
                                        </div>
                                    </div>



                                </div>




                                <div class="form-group">
                                    <label for="Ubicacion">Agregar ubicación:</label>
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#exampleModal"> <i class="bi bi-geo-alt-fill"></i></button>
                                    @include('modal-ubicacion')
                                </div>
                                <div class="row py-4">
                                    <div class="col-md-6">
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
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_fin">Fecha de finalización <span
                                                    class="text-danger font-weight-bold ">*</span></label>
                                            <input type="datetime-local" name="fecha_fin"
                                                class="form-control @error('fecha_fin') is-invalid @enderror"
                                                id="fecha_fin" value="{{ old('fecha_fin') }}" required
                                                aria-describedby="fecha_fin_help">
                                            @error('fecha_fin')
                                                <span id="fecha_fin_help" class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p class="h6">Modalidad del evento<span
                                            class="text-danger font-weight-bold ">*</span></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="modalidad"
                                            id="modalidad1" value="individual"
                                            {{ old('modalidad') == 'individual' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="modalidad1">
                                            Evento individual
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="modalidad"
                                            id="modalidad2" value="grupal"
                                            {{ old('modalidad') == 'grupal' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="modalidad2">
                                            Evento grupal
                                        </label>
                                    </div>
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
                                    <label for="privacidad">Requisitos del Evento</label>
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
                                        <input type="checkbox" name="mostrarCosto" id="mostrarCosto"> Costo del
                                        Evento (Bs)
                                        <div class="slider">

                                            <input type="range" name="costo" id="formCosto" min="0"
                                                max="1000" value="{{ old('costo', 0) }}"
                                                oninput="updateRangeValue('rangeValue3', 'formCosto')">
                                            <p id="rangeValue3">0</p>
                                            @error('costo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="checkbox" name="mostrarCantidadMaxima"
                                            id="mostrarCantidadMaxima">
                                        <label class="form-check-label" id="mostrarCantidadMaximaL"
                                            for="mostrarCantidadMaxima">
                                            Cantidad máxima de participantes
                                        </label>
                                        <div class="slider">

                                            <input name="cantidad_maxima" type="range" id="formMaximo"
                                                min="10" max="300"
                                                value="{{ old('cantidad_maxima', 100) }}"
                                                oninput="updateRangeValue('rangeMax', 'formMaximo', 'formMinimo')">
                                            <p id="rangeMax">100</p>
                                            @error('cantidad_maxima')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="checkbox" name="mostrarCantidadMinima"
                                            id="mostrarCantidadMinima">
                                        <label class="form-check-label" id="mostrarCantidadMinimaL"
                                            for="mostrarCantidadMinima">
                                            Cantidad mínima de participantes
                                        </label>
                                        <div class="slider">

                                            <input type="range" name="cantidad_minima" id="formMinimo"
                                                min="0" max="200"
                                                value="{{ old('cantidad_minima', 10) }}"
                                                oninput="updateRangeValue('rangeValue1', 'formMinimo')">
                                            <p id="rangeValue1">10</p>
                                            @error('cantidad_minima')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>


                                    <div  class="pb-4">
                                        @livewire('eventos-dropdown')
                                    </div>




                                </div>

                            </div>

                        </div>
                        <div class="row py-4">
                            <div class="col d-flex"> <span class="text-danger font-weight-bold ">* Indica que el campo
                                    es obligatorio</span></div>
                            <div class="col d-flex justify-content-end">
                                <div class="form-group">
                                    <a href="#" class="btn btn-cancelar"
                                        onclick="confirmarCancelacion()">Cancelar</a>
                                    <button type="submit" class="btn btn-info" id="nextBtn">Crear
                                        Evento</button>
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

            $('#campos-adicionales input[type="text"]').hide();
            $('#campos-adicionales .slider').hide();


            $('input[type="checkbox"]').change(function() {
                var campoAsociado = $(this).siblings('.slider');
                campoAsociado.toggle(); // Muestra u oculta el campo según el estado del checkbox
            });


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
        $(document).ready(function() {
            $('#campos-adicionales').hide();
            $('#tipo_evento').hide();
            $('#privacidad').change(function() {
                if ($(this).val() === 'con-restriccion') {
                    $('#campos-adicionales').show();
                } else {
                    $('#campos-adicionales').hide();
                }
            });
            $("#selectorTipo").selectmenu({
                change: function(event, data) {
                    if (data.item.value == "Otro") {
                        console.log('Visible');
                        $("#tipo_evento").val("");
                        $('#tipo_evento').show();
                    } else {
                        $("#tipo_evento").val(data.item.value);
                        $('#tipo_evento').hide();
                        console.log('Invisible');
                    }

                },
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
    <script>
        // Verificar si ninguno de los radio buttons está seleccionado
        $(document).ready(function() {
            if ($('input[name="modalidad"]:checked').length === 0) {
                // Ninguno está seleccionado, seleccionar por defecto "individual"
                $('#modalidad1').prop('checked', true);
            }
        });
        $('input:radio[name="modalidad"]').change(
            function() {
                if (this.checked) {
                    console.log(this.value)
                    if (this.value == 'individual') {
                        $('#mostrarCantidadMinimaL').text("Cantidad minima de participantes");
                        $('#mostrarCantidadMaximaL').text("Cantidad máxima de participantes");
                    } else {
                        $('#mostrarCantidadMinimaL').text("Cantidad minima de grupos");
                        $('#mostrarCantidadMaximaL').text("Cantidad máxima de grupos");
                    }

                }
            });
    </script>

    <script>
        function updateRangeValue(elementId, inputId, linkedInputId) {
            const rangeValueElement = document.getElementById(elementId);
            const inputValue = document.getElementById(inputId).value;
            rangeValueElement.innerText = inputValue;

            if (linkedInputId) {
                const linkedInput = document.getElementById(linkedInputId);
                linkedInput.max = inputValue;
            }
        }
    </script>

    @include('layouts.mensajes-alerta')
    @livewireScripts
</body>

</html>
