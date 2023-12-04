<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Evento</title>
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

            <div class="contenedor-flex">

                <div class="container contact-form">
                    <form method="POST"
                        action="{{ route('evento.update', ['user' => auth()->user()->id, 'evento' => $miEvento->id]) }}"
                        id="FormCrearEvento">
                        @csrf
                        @method('PUT')
                        <div class="d-flex justify-content-center"><span class="icono-creacion"><i
                                    class="bi bi-calendar2-plus-fill display-1"></i></span></div>

                        <h2 id="register">Modificar Evento</h2>
                        <div class="all-steps" id="all-steps">
                            <span class="step"><i class="bi bi-newspaper"></i></span>
                            <span class="step"><i class="bi bi-calendar3"></i>
                            </span>
                            <span class="step"><i class="fa fa-shopping-bag"></i></span>
                            <span class="step"><i class="bi bi-paperclip"></i></span>
                            <span class="step"><i class="bi bi-incognito"></i></span>
                        </div>
                        <div class="tab">
                            @php
                                $misValores = session()->getOldInput();
                                $auspiciadores_old = isset($misValores['Auspiciadores']) ? $misValores['Auspiciadores'] : [];
                                $misAuspiciadores = isset($miEvento->auspiciadors) ? $miEvento->auspiciadors : [];
                                $miAuspiciadores = [];
                                if (count($auspiciadores_old)) {
                                    $miAuspiciadores = $auspiciadores_old;
                                } else {
                                    foreach ($misAuspiciadores as $auspiciador) {
                                        $miAuspiciadores[] = $auspiciador->nombre;
                                    }
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
                                        <label for="Ubicacion">Agregar ubicación:</label>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#exampleModal"> <i class="bi bi-geo-alt-fill"></i></button>
                                        @include('layouts.modal-editar-ubicacion')
                                    </div>
                                    <div class="form-group">
                                        <label for="auspiciadoresSelect">Seleccione Auspiciadores: </label>
                                        <select id="auspiciadoresSelect" class="form-select"
                                            aria-label="Default select example">
                                            <option selected disabled>Lista de auspiciadores</option>

                                            @if ($auspiciadores)
                                                @foreach ($auspiciadores as $auspiciador)
                                                    <option value="{{ $auspiciador->nombre }}">
                                                        {{ $auspiciador->nombre }}
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
                                        <div class="row pb-4">
                                            <div class="col-md-6"> <label for="combined_start">Fecha de inicio</label>
                                                <input type="datetime-local" name="combined_start"
                                                    class="form-control @error('combined_start') is-invalid @enderror"
                                                    id="combined_start"
                                                    value="{{ $miEvento->fecha_inicio }} {{ $miEvento->tiempo_inicio }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="combined_end">Fecha de finalización</label>
                                                <input type="datetime-local" name="combined_end"
                                                    class="form-control @error('combined_end') is-invalid @enderror"
                                                    id="combined_end"
                                                    value="{{ $miEvento->fecha_fin }} {{ $miEvento->tiempo_fin }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row pt-4 p-4">
                                            <label class="text-danger font-weight-bold">Modifique las fechas
                                                directamente en
                                                el cronograma</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="descripcion_evento">Descripcion del Evento</label>
                                        <textarea type="text" name="descripcion_evento"
                                            class="form-control @error('descripcion_evento') is-invalid @enderror" id="descripcion_evento" required
                                            aria-describedby="descripcion_evento_help" placeholder="Ingrese la descripcion del evento"
                                            style="width: 100%; height: 300px;">{{ old('descripcion_evento', $miEvento->descripcion_evento) }}</textarea>
                                        @error('descripcion_evento')
                                            <span id="descripcion_evento_help"
                                                class="text-danger">{{ $message }}</span>
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
                        </div>
                        <div class="tab" id="ultimaTab"></div>

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
    <script src="{{ asset('js/jquery-ui.js') }}"></script>

    @include('layouts.mensajes-alerta')
    <script src="{{ asset('js/ubicacionYauspiciador.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHfE5-hGkrVMcsw7p6rA4AQR-r1WU3tZY&libraries=places&callback=iniciarMapa">
    </script>
    <script src="{{ asset('js/script-crear-evento.js') }}"></script>
    <script>
        var auspiciadoresArray = @json($miAuspiciadores);
        for (const iterator of auspiciadoresArray) {
            addRecipient(iterator);
        }
    </script>
</body>

</html>
