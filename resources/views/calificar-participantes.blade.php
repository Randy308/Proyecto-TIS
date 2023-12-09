<!DOCTYPE html>
<html lang="es">

<head>
    <title>Calificar participantes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-query.css') }}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    @include('layouts/estilos')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css"
        rel="stylesheet" />

    <script>
        $.fn.poshytip = {
            defaults: null
        }
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js">
    </script>
    <link rel="stylesheet" href="{{ asset('css/calificaciones.css') }}">

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="container py-4 my-4 p-4" id="miTabla">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-danger" href="{{ route('calificaciones.index', ['evento_id' => $evento->id]) }}"
                        type="submit"><i class="bi bi-x-lg"></i></a>
                </div>
                <p class="h3">Lista de participantes</p>
                <div class="py-4">
                    <p class="h6">Nota minima de reprobacion: <span class="text-danger">0</span></p>
                    <p class="h6">Nota minima de aprobacion: <span
                            class="text-warning">{{ $calificacion->nota_minima_aprobacion }}</span></p>
                    <p class="h6">Nota maxima: <span class="text-success">{{ $calificacion->nota_maxima }}</span>
                    </p>
                </div>
                <table class="table table-bordered data-table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Puntaje</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($combinedData as $data)
                            <tr>
                                {{-- <td>{{ $data->calificacion_id }}</td>
                                <td>
                                    <a href="" class="update" data-name="name" data-type="text"
                                        data-pk="{{ $data->user_id }}" data-title="Enter name"></a>
                                </td>
                                <td>
                                    <a href="" class="update" data-name="email" data-type="text"
                                        data-pk="{{ $data->user_id }}" data-title="Enter email">{{ $data->email }}</a>
                                </td>
                                <td>
                                    <a href="" class="update" data-name="estado" data-type="select"
                                        data-pk="{{ $data->user_id }}" data-title="Seleccione el estado"
                                        data-source='{"habilitado": "Habilitado", "deshabilitado": "Deshabilitado"}'>
                                        {{ $data->estado }}
                                    </a>
                                </td> --}}

                                <td>{{ $data->calificacion_id }}</td>
                                <td>
                                    {{ $data->name }}

                                </td>
                                <td>
                                    {{ $data->email }}

                                </td>
                                <td id="Puntaje{{ $data->user_id }}"
                                    class=" {{ $data->puntaje < $data->nota_minima_aprobacion ? 'table-danger' : 'table-success' }}">
                                    <a href="#" class="update" data-name="puntaje" data-type="text"
                                        data-medio="{{ $data->nota_minima_aprobacion }}" data-minimo="0"
                                        data-maximo="{{ $data->nota_maxima }}" data-pk="{{ $data->user_id }}"
                                        data-calificacion="{{ $data->calificacion_id }}"
                                        data-title="Ingrese Puntaje">{{ $data->puntaje }}</a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')

    <script>
        $(document).ready(function() {
            $('.update').on('click', function() {
                $(".editable-submit").addClass("btn btn-success btn-sm");
                $(".editable-cancel").addClass("btn btn-danger btn-sm");
                $(".editable-submit").html('Guardar');
                $(".editable-cancel").html('Cancelar');
            });
        });

        function crearToast(mensaje) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right"
            }
            toastr.error(mensaje);
        }
    </script>
    <script type="text/javascript">
        $.fn.editable.defaults.mode = 'inline';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('.update').editable({
            url: "{{ route('calificar.update') }}",
            showbuttons: 'bottom', // Muestra los botones en la parte inferior
            type: 'text',
            pk: 1,
            validate: function(value) {
                if ($.trim(value) == '') {
                    crearToast('El campo es requerido');
                    return false;
                }
                if (!$.isNumeric(value)) {
                    crearToast('Ingrese un numero');
                    return false;
                }
                if (value > $(this).data('maximo')) {
                    crearToast('Debe ingresar un numero menor o igual a ' + $(this).data('maximo'));
                    return false;
                }
                if ($.trim(value) < $(this).data('minimo')) {
                    crearToast('Debe ingresar un numero mayor o igual a ' + $(this).data('minimo'));
                    return false;
                }
            },
            params: function(params) {
                // Obtener el valor del atributo data-calificacion-id del enlace
                params.calificacion = $(this).data('calificacion');
                return params;
            },
            name: 'name',
            title: 'Enter name',
            success: function(data) {
                console.log(data);
                var cell = $('#Puntaje' + $(this).data('pk'));
                console.log("Puntaje " + data.puntaje);
                console.log("Medio " + $(this).data('medio'));
                console.log("ID " + $(this).data('pk'));
                if (data.puntaje < $(this).data('medio')) {

                    cell.removeClass('table-success').addClass('table-danger');
                } else {
                    cell.removeClass('table-danger').addClass('table-success');

                }
            },
            error: function(errors) {
                console.error(errors); // Muestra los errores en la consola si hay alguno
            }
        });
    </script>



</body>

</html>
