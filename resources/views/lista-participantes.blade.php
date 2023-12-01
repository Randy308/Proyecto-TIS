<!DOCTYPE html>
<html lang="es">

<head>
    <title>Lista participantes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('layouts.boostrap5')
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
    @livewireStyles


</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            @livewire('lista-participantes', ['evento_id' => $evento_id])
        </div>

    </div>


    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    @livewireScripts
    <script type="text/javascript">
        $.fn.editable.defaults.mode = 'inline';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('.update').editable({
            url: "{{ route('calificar.update') }}",
            type: 'select',
            pk: 1,
            name: 'name',
            title: 'Enter name'
        });
    </script>
<script>
    var csrfToken = "{{ csrf_token() }}";
</script>
    <script>
        $(document).ready(function() {
            $('.enable-participation, .reject-participation').click(function() {
                var asistencia_id = $(this).data('asistencia_id');
                var action = $(this).hasClass('enable-participation') ? 'Habilitado' : 'Denegado';
                // Realiza la solicitud Ajax según la acción
                $.ajax({
                    type: 'POST',
                    url: "{{ route('estado.update') }}",
                    data: {
                        asistencia_id: asistencia_id,
                        action: action,
                        name: "estado",
                        _token: csrfToken 
                    },
                    success: function(response) {
                        // Maneja la respuesta del servidor aquí
                        console.log(response);

                        // Puedes actualizar la interfaz de usuario según sea necesario
                        $('#user_row_' + asistencia_id)
                            .fadeOut(); // Ejemplo: Oculta la fila después de la acción
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>


</body>

</html>
