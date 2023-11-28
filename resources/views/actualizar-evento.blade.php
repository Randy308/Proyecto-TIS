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
                                    <label for="combined_start">Fecha de inicio <span class="text-danger font-weight-bold">*</span></label>
                                    <input type="datetime-local" name="combined_start"
                                           class="form-control @error('combined_start') is-invalid @enderror" id="combined_start"
                                           value="{{ old('combined_start') ?: $miEvento->combined_start }}" required aria-describedby="combined_start_help">
                                    @error('combined_start')
                                        <span id="combined_start_help" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="combined_end">Fecha de finalización <span class="text-danger font-weight-bold">*</span></label>
                                    <input type="datetime-local" name="combined_end"
                                           class="form-control @error('combined_end') is-invalid @enderror" id="combined_end"
                                           value="{{ old('combined_end') ?: $miEvento->combined_end }}" required aria-describedby="combined_end_help">
                                    @error('combined_end')
                                        <span id="combined_end_help" class="text-danger">{{ $message }}</span>
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
                                <div class="form-group">
                                    <label for="privacidad">Privacidad del Evento</label>
                                    <select name="privacidad" class="form-control @error('privacidad') is-invalid @enderror" id="privacidad" required>
                                        <option value="libre" {{ old('privacidad', $miEvento->privacidad) == 'libre' ? 'selected' : '' }}>Libre</option>
                                        <option value="con-restriccion" {{ old('privacidad', $miEvento->privacidad) == 'con-restriccion' ? 'selected' : '' }}>Con Restriccion</option>
                                    </select>
                                    @error('privacidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div id="campos-adicionales">
                                    
                                    
                                        <div class="form-group">
                                            Costo del Evento
                                            <input type="text" name="costo" class="form-control @error('costo') is-invalid @enderror" id="costo"
                                                placeholder="Ingrese el costo del evento" value="{{ old('costo', $miEvento->costo) }}">
                                            @error('costo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                
                                        <div class="form-group">
                                                {{ old('mostrarCantidadMinima') ? 'checked' : '' }}> Cantidad mínima de participantes
                                            <input type="text" name="cantidad_minima"
                                                class="form-control @error('cantidad_minima') is-invalid @enderror" id="cantidad_minima"
                                                placeholder="Ingrese la cantidad mínima de participantes"
                                                value="{{ old('cantidad_minima', $miEvento->cantidad_minima) }}">
                                            @error('cantidad_minima')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                
                                        <div class="form-group">
                                                {{ old('mostrarCantidadMaxima') ? 'checked' : '' }}> Cantidad máxima de participantes
                                            <input type="text" name="cantidad_maxima"
                                                class="form-control @error('cantidad_maxima') is-invalid @enderror" id="cantidad_maxima"
                                                placeholder="Ingrese la cantidad máxima de participantes"
                                                value="{{ old('cantidad_maxima', $miEvento->cantidad_maxima) }}">
                                            @error('cantidad_maxima')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            @livewire('eventos-dropdown')
                                        </div>




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
