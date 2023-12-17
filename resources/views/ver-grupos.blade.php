<!DOCTYPE html>
<html lang="es">

<head>
    <title>Lista de grupos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('layouts.boostrap5')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-query.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    @include('layouts/estilos')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    @livewireStyles
    <style>
        body{
            background-color: whitesmoke;
        }
        #listaIntegrantesGrupos{
            background-color: white;
            border-radius: 20px;
            border: solid whitesmoke;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            @livewire('lista-grupos', ['evento_id' => $evento_id])
        </div>

    </div>


    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    @livewireScripts
</body>

</html>
