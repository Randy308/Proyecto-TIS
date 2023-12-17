<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fases del evento</title>
    @include('layouts/estilos')
    @livewireStyles
    <style>
        body{
            background-color: whitesmoke;
        }
        #contenedor{
            border-radius: 20px;
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">

            @include('layouts/navbar')

            <div class="container my-4 py-4" id="contenedor">
                <div class="d-flex justify-content-end"><a href="{{ route('verEvento', $evento->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i></a></div>
                @livewire('user-search', ['evento_id' => $evento->id])

            </div>

        </div>

    </div>

    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    @livewireScripts

</body>

</html>
