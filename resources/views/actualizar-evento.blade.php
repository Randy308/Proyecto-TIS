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
    <style>
        body {
            background-color: whitesmoke;
            transition: background-color 0.3s ease;
        }

        #miContenedor {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="container-sm my-4">
                <div class="row justify-content-center">
                    <div class="col-md-8" id="miContenedor">
                        <form method="POST"
                            action="{{ route('evento.update', ['user' => auth()->user()->id, 'evento' => $miEvento->id]) }}"
                            id="FormCrearEvento">
                            @csrf
                            @method('PUT')
                            <div class="d-flex justify-content-end"><a href="#" class="btn btn-danger btn-sm" onclick="confirmarCancelacion()"><i class="bi bi-x-lg"></i></a></div>
                            <div class="d-flex justify-content-center"><span class="icono-creacion"><i
                                        class="bi bi-calendar2-plus-fill display-1"></i></span></div>

                            <h1 id="register">Modificar Evento</h1>
                            <div class="all-steps" id="all-steps">
                                <span class="step"><i class="bi bi-newspaper"></i></span>
                                <span class="step"><i class="bi bi-calendar3"></i>
                                </span>
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
                                                <div class="col-md-auto"> <label for="combined_start">Fecha de
                                                        inicio</label>
                                                    <input type="datetime-local" name="combined_start"
                                                        class="form-control @error('combined_start') is-invalid @enderror"
                                                        id="combined_start"
                                                        value="{{ $miEvento->fecha_inicio }} {{ $miEvento->tiempo_inicio }}"
                                                        readonly>
                                                </div>
                                                <div class="col-md-auto">
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

                                    </div>
                                </div>
                            </div>




                            <div class="tab" id="ultimaTab">
                                <div class="form-group py-4">
                                    <label for="tipo_evento">Tipo de Evento<span
                                            class="text-danger font-weight-bold ">*</span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select id="selectorTipo"
                                                class="form-control @error('tipo_evento') is-invalid @enderror">
                                                <option value="Reclutamiento">
                                                    Reclutamiento
                                                </option>
                                                <option value="Competencia">
                                                    Competencia</option>
                                                <option value="Taller">
                                                    Taller</option>

                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="tipo_evento"
                                                class="form-control @error('tipo_evento') is-invalid @enderror"
                                                id="tipo_evento" value="{{ old('tipo_evento', $miEvento->tipo_evento) }}"
                                                placeholder="Ingrese el nombre del evento" required
                                                aria-describedby="tipo_evento_help">
                                            @error('tipo_evento')
                                                <span id="tipo_evento_help" class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="alert alert-danger" role="alert" id="tipo_eventoCheck">

                                            </div>
                                            @error('tipo_evento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                </div>
                                <div class="form-group">
                                    <p class="h5">Modalidad del evento</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="modalidad" id="modalidad1" value="individual"
                                        {{ $miEvento->modalidad == "individual" ? 'checked' : '' }} >
                                        <label class="form-check-label" for="modalidad1">
                                         Evento individual
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="modalidad" id="modalidad2" value="grupal"
                                        {{ $miEvento->modalidad == "grupal" ? 'checked' : '' }} >
                                        <label class="form-check-label" for="modalidad2">
                                            Evento grupal
                                        </label>
                                      </div>
                                </div>
                                <div class="form-group">
                                    <label for="privacidad">Privacidad del Evento</label>
                                    <select name="privacidad"
                                        class="form-control @error('privacidad') is-invalid @enderror" id="privacidad"
                                        required>
                                        <option value="libre"  {{ $miEvento->privacidad == "libre" ? 'selected' : '' }}>Libre</option>
                                        <option value="con-restriccion"  {{ $miEvento->privacidad == "con-restriccion" ? 'selected' : '' }} >Con Restriccion</option>
                                    </select>
                                    @error('privacidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div id="campos-adicionales" class="{{ $miEvento->privacidad == "libre" ? 'sin-restriccion' : '' }}  ">

                                    <div class="form-group">
                                        Costo del Evento
                                        <input type="text" name="costo"
                                            class="form-control @error('costo') is-invalid @enderror" id="costo"
                                            placeholder="Ingrese el costo del evento"
                                            value="{{ old('costo', $miEvento->costo) }}">
                                        @error('costo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Cantidad mínima de participantes
                                                <input type="text" name="cantidad_minima"
                                                    class="form-control @error('cantidad_minima') is-invalid @enderror"
                                                    id="cantidad_minima"
                                                    placeholder="Ingrese la cantidad mínima de participantes"
                                                    value="{{ old('cantidad_minima', $miEvento->cantidad_minima) }}">
                                                @error('cantidad_minima')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                Cantidad máxima de participantes
                                                <input type="text" name="cantidad_maxima"
                                                    class="form-control @error('cantidad_maxima') is-invalid @enderror"
                                                    id="cantidad_maxima"
                                                    placeholder="Ingrese la cantidad máxima de participantes"
                                                    value="{{ old('cantidad_maxima', $miEvento->cantidad_maxima) }}">
                                                @error('cantidad_maxima')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox"name="selectedInstitucion"> Activar restriccion por instituciones
                                        </label>

                                        <label class="form-label" for="formInstitucion">Seleccione su
                                            Institucion</label><br>
                                        <select class="form-control form-control" class="form-select"
                                            name="institucion" id="formInstitucion">
                                            <option value="1" disabled>Instituciones</option>
                                            @if ($instituciones)
                                                @foreach ($instituciones as $item)
                                                    <option value="{{ $item }}"
                                                        {{ $miEvento->nombre_institucion == $item ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            @else
                                                <option value="Otros" disabled>No existen instituciones</option>


                                            @endif
                                        </select>
                                    </div>




                                </div>
                            </div>
                            <div class="d-flex gap-4 justify-content-end " style="gap:10px;">

                                <button type="button" class="btn btn-info btn-sm" id="prevBtn" onclick="prev(1)"> <i
                                        class="fa fa-angle-double-left "></i> Anterior</button>
                                <button type="button" class="btn btn-primary btn-sm" id="nextBtn"
                                    onclick="next(1)">Siguiente <i class="fa fa-angle-double-right"></i></button>
                            </div>

                        </form>
                    </div>
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
    <script>
        $(document).ready(function() {

            $('#privacidad').change(function() {
                if ($(this).val() === 'con-restriccion') {
                    $( "#campos-adicionales" ).removeClass( "sin-restriccion" )

                   // $('#campos-adicionales').show();
                } else {
                    $( "#campos-adicionales" ).addClass( "sin-restriccion" )
                   // $('#campos-adicionales').hide();
                }
            });

        });
    </script>
        <script>
            $(document).ready(function() {
                $("#selectorTipo").selectmenu({
                    change: function(event, data) {
                        $("#tipo_evento").val(data.item.value);
                    },
                });
            });
        </script>
    <script>
        var currentTab = 0;
        document.addEventListener("DOMContentLoaded", function(event) {


            showTab(currentTab);

        });

        function showTab(n) {
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = 'Actualizar evento';
            } else {
                document.getElementById("nextBtn").innerHTML = 'Siguiente <i class="fa fa-angle-double-right"></i>';
            }
            fixStepIndicator(n)
        }

        function prev(n) {
            var x = document.getElementsByClassName("tab");
            if (currentTab == 0) {
                return
            }
            x[currentTab].style.display = "none";
            currentTab = currentTab - n;

            if (currentTab >= x.length) {

                document.getElementById("nextprevious").style.display = "none";
                document.getElementById("all-steps").style.display = "none";
                document.getElementById("register").style.display = "none";
                document.getElementById("text-message").style.display = "block";




            }
            showTab(currentTab);
        }

        function next(n) {
            var x = document.getElementsByClassName("tab");
            if (currentTab == (x.length - 1)) {
                document.getElementById("FormCrearEvento").submit();
                return
            }
            x[currentTab].style.display = "none";
            currentTab = currentTab + n;
            if (currentTab >= x.length) {

                document.getElementById("nextprevious").style.display = "none";
                document.getElementById("all-steps").style.display = "none";
                document.getElementById("register").style.display = "none";
                document.getElementById("text-message").style.display = "block";




            }
            showTab(currentTab);
        }



        function fixStepIndicator(n) {
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }
    </script>
    <script>
        function confirmarCancelacion() {
            if (confirm("¿Estás seguro de que deseas salir? Todos los cambios no guardados se perderán.")) {
                window.location.href = "{{ route('misEventos') }}";
            }
        }
    </script>
    <script src="{{ asset('js/validaciones-formulario.js') }}"></script>
</body>

</html>
