<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @include('layouts/estilos')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-query.css') }}">
    <link rel="stylesheet" href="{{ asset('css/prueba-crear.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
        integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/ubicacionevento.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="container-sm mt-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('crear-evento') }}" id="FormCrearEvento">
                            @csrf
                            <div class="d-flex justify-content-center"><span class="icono-creacion"><i
                                        class="bi bi-calendar2-plus-fill display-1"></i></span></div>
                            <h1 id="register">Crear Evento</h1>
                            @php
                                $misValores = session()->getOldInput();
                                $miAuspiciadores = isset($misValores['Auspiciadores']) ? $misValores['Auspiciadores'] : [];
                            @endphp
                            <div class="all-steps" id="all-steps">
                                <span class="step"><i class="bi bi-newspaper"></i></span>
                                <span class="step"><i class="bi bi-calendar3"></i>
                                </span>
                                <span class="step"><i class="fa fa-shopping-bag"></i></span>
                                <span class="step"><i class="bi bi-paperclip"></i></span>
                                <span class="step"><i class="bi bi-incognito"></i></span>
                            </div>


                            <div class="tab">
                                <div>
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
                                        <label for="Ubicacion">Agregar ubicación:</label>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#exampleModal"> <i class="bi bi-geo-alt-fill"></i></button>
                                        @include('modal-ubicacion')
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_evento">Tipo de Evento</label>
                                        <select name="tipo_evento"
                                            class="form-control @error('tipo_evento') is-invalid @enderror"
                                            id="tipo_evento">
                                            <option value="reclutamiento"
                                                {{ old('tipo_evento') == 'reclutamiento' ? 'selected' : '' }}>
                                                Reclutamiento
                                            </option>
                                            <option value="competencia_individual"
                                                {{ old('tipo_evento') == 'competencia_individual' ? 'selected' : '' }}>
                                                Competencia Individual</option>
                                            <option value="competencia_grupal"
                                                {{ old('tipo_evento') == 'competencia_grupal' ? 'selected' : '' }}>
                                                Competencia Grupal(4)</option>
                                            <option value="taller_individual"
                                                {{ old('tipo_evento') == 'taller_individual' ? 'selected' : '' }}>
                                                Taller
                                                Individual</option>
                                            <option value="taller_grupal"
                                                {{ old('tipo_evento') == 'taller_grupal' ? 'selected' : '' }}>Taller
                                                Grupal(4)
                                            </option>
                                        </select>
                                        @error('tipo_evento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="d-flex"><span class="text-danger font-weight-bold ">* Indica que el campo
                                        es obligatorio</span></div>
                                </div>

                            </div>
                            <div class="tab">
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
                                <div class="d-flex"><span class="text-danger font-weight-bold ">* Indica que el campo
                                    es obligatorio</span></div>
                            </div>
                            <div class="tab">
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

                            </div>
                            <div class="tab">
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
                            </div>

                            <div class="tab" id="ultimaTab">
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
                                        <input type="checkbox" name="mostrarCosto" id="mostrarCosto"> Costo del
                                        Evento
                                        <input type="text" name="costo"
                                            class="form-control @error('costo') is-invalid @enderror" id="costo"
                                            placeholder="Ingrese el costo del evento" value="{{ old('costo') }}">
                                        @error('costo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <input type="checkbox" name="mostrarCantidadMinima"
                                            id="mostrarCantidadMinima"> Cantidad mínima de participantes
                                        <input type="text" name="cantidad_minima"
                                            class="form-control @error('cantidad_minima') is-invalid @enderror"
                                            id="cantidad_minima"
                                            placeholder="Ingrese la cantidad mínima de participantes"
                                            value="{{ old('cantidad_minima') }}">
                                        @error('cantidad_minima')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <input type="checkbox" name="mostrarCantidadMaxima"
                                            id="mostrarCantidadMaxima"> Cantidad máxima de participantes
                                        <input type="text" name="cantidad_maxima"
                                            class="form-control @error('cantidad_maxima') is-invalid @enderror"
                                            id="cantidad_maxima"
                                            placeholder="Ingrese la cantidad máxima de participantes"
                                            value="{{ old('cantidad_maxima') }}">
                                        @error('cantidad_maxima')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        @livewire('eventos-dropdown')
                                    </div>




                                </div>
                            </div>
                            <div style="overflow:auto;" id="nextprevious">
                                <div class="d-flex flex-row justify-content-end flex-wrap gap-3 p-3">
                                    <button type="button" class="btn btn-info" id="prevBtn" onclick="prev(1)"> <i
                                            class="fa fa-angle-double-left"></i> Anterior</button>
                                    <button type="button" class="btn btn-primary" id="nextBtn"
                                        onclick="next(1)">Siguiente <i class="fa fa-angle-double-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="{{ old('Auspiciadores[]') }}">
    </div>


    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')


    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/ubicacionYauspiciador.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHfE5-hGkrVMcsw7p6rA4AQR-r1WU3tZY&libraries=places&callback=iniciarMapa">
    </script>
    <script src="{{ asset('js/script-fecha.js') }}"></script>
    <script src="{{ asset('js/crear-prueba.js') }}"></script>
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
    <script src="{{ asset('js/validaciones-formulario.js') }}"></script>
    @livewireScripts

</body>

</html>
