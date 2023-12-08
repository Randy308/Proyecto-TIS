<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Cronograma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @include('layouts/estilos')
    <style>
        .tabla-header {

            font-size: smaller;
        }

        body {
            background-color: whitesmoke;
        }

        #listaIntegrantesGrupos {
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
            <div class="container contact-form py-4 my-4" id="listaIntegrantesGrupos">
                <br>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-danger"  href="{{ route('misEventos',['tab' => 1]) }}" type="submit"><i
                        class="bi bi-x-lg"></i></a>
                </div>
                <div class="d-flex justify-content-center px-4">
                    <p class="h4">Gestión del Cronograma</p>
                </div>
                @php
                    $editable = true;
                @endphp
                @livewire('actualizar-cronograma', ['idEvento' => $evento->id, 'editable' => $editable ,'miFaseActual'=>$miFaseActual])

            </div>

        </div>
    </div>

    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        < /body>

        <
        /html>
