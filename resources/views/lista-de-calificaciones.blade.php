<!DOCTYPE html>
<html lang="es">

<head>
    <title>Lista de calificaciones</title>
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
        body {
            background-color: whitesmoke;
        }

        #listaIntegrantesGrupos {
            background-color: white;
            border-radius: 20px;
            border: solid whitesmoke;
        }


        .slider {

            display: flex;
            align-items: center;
            
        }

        .slider p {
            font-size: 16px;
            font-weight: 600;
            font-family: Open Sans;
            padding-left: 30px;
            color: black;
        }

        .slider input[type="range"] {
            -webkit-appearance: none !important;
            width: 420px;
            height: 2px;
            background: black;
            border: none;
            outline: none;
        }

        .slider input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none !important;
            width: 10px;
            height: 10px;
            background: black;
            border: 2px solid black;
            border-radius: 50%;
            cursor: pointer;
        }

        .slider input[type="range"]::-webkit-slider-thumb:hover {
            background: black;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            @livewire('lista-calificaciones', ['evento_id' => $evento_id, 'anterior' => $anterior, 'existe' => $existe])
        </div>

    </div>


    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    <script src="{{ asset('js/validaciones-formulario.js') }}"></script>
    @livewireScripts
</body>

</html>
