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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_evento">Nombre del Evento <span class="text-danger font-weight-bold ">*</span></label>
                                    <input type="text" name="nombre_evento"
                                        class="form-control @error('nombre_evento') is-invalid @enderror"
                                        id="nombre_evento" value="{{ old('nombre_evento') }}"
                                        placeholder="Ingrese el nombre del evento" required
                                        aria-describedby="nombre_evento_help">
                                    @error('nombre_evento')
                                        <span id="nombre_evento_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Ubicacion">Agregar ubicación:</label>
                                   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"> <i class="bi bi-geo-alt-fill"></i></button>
                                   @include('modal-ubicacion')
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
                                    <label for="fecha_inicio">Fecha de inicio <span class="text-danger font-weight-bold ">*</span></label>
                                    <input type="date" name="fecha_inicio"
                                        class="form-control @error('fecha_inicio') is-invalid @enderror"
                                        id="fecha_inicio" value="{{ old('fecha_inicio') }}" required
                                        aria-describedby="fecha_inicio_help">
                                    @error('fecha_inicio')
                                        <span id="fecha_inicio_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="fecha_fin">Fecha de finalización <span class="text-danger font-weight-bold ">*</span></label>
                                    <input type="date" name="fecha_fin"
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
                                </div>



                            </div>
                            <div class="col d-flex"> <span class="text-danger font-weight-bold ">* Indica que el campo es obligatorio</span></div>
                            <div class="col d-flex justify-content-end">
                                <div class="form-group">
                                    <a href="#" class="btn btn-cancelar"
                                        onclick="confirmarCancelacion()">Cancelar</a>
                                    <button type="submit" class="btn btn-info">Crear Evento</button>
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

            </div>


        </div>
    </div>

    @include('layouts/sidebar-scripts')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/ubicacionYauspiciador.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHfE5-hGkrVMcsw7p6rA4AQR-r1WU3tZY&libraries=places&callback=iniciarMapa">
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
            $('#fecha_inicio').val(currentDate);
        });
    </script>
    <script src="{{ asset('js/script-crear-evento.js') }}"></script>
    @include('layouts.mensajes-alerta')

</body>

</html>
