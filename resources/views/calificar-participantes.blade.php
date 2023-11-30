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


</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="container py-4">
                <p class="h3">Lista de participantes</p>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <a href="" class="update" data-name="name" data-type="text"
                                        data-pk="{{ $user->id }}" data-title="Enter name">{{ $user->name }}</a>
                                </td>
                                <td>
                                    <a href="" class="update" data-name="email" data-type="text"
                                        data-pk="{{ $user->id }}" data-title="Enter email">{{ $user->email }}</a>
                                </td>
                                <td>
                                    <a href="" class="update" data-name="estado" data-type="select"
                                        data-pk="{{ $user->id }}" data-title="Seleccione el estado"
                                        data-source='{"habilitado": "Habilitado", "deshabilitado": "Deshabilitado"}'>
                                        {{ $user->estado }}
                                    </a>
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

    <script type="text/javascript">
        $.fn.editable.defaults.mode = 'inline';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('.update').editable({
            url: "{{ route('calificar.update') }}",
            type: 'text',
            pk: 1,
            name: 'name',
            title: 'Enter name'
        });
    </script>

</body>

</html>
