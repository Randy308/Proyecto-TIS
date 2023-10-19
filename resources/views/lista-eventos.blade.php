<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Evento</title>
    @include('layouts/estilos')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listEvent.css') }}">
    <style>
        .navbar-custom {
            background-color: #007BFF;
            color: #fff;
        }
    </style>


    @livewireStyles

</head>

<body>


    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')


            <h1>Listado de Eventos</h1>

            @livewire('evento-list')


        </div>
    </div>

    @include('layouts/sidebar-scripts')


</body>

</html>
