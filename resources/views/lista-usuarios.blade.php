<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    @include('layouts/estilos')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/listUser.css') }}">
    <style>
        .navbar-custom {
            background-color: #007BFF;
            color: #fff;
        }
    </style>


    @livewireStyles

</head>

<body>

    @include('layouts.mensajes-alerta')
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')

            <div class="d-flex justify-content-center mt-5">
                <h3>Listado de Usuarios</h3>
            </div>
            @livewire('usuario-list')

        </div>
    </div>
    @include('layouts.sidebar-scripts')
</body>

</html>
