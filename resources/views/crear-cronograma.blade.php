<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar  Cronograma</title>
    @include('layouts/estilos')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ubicacionevento.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
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
                @php
                    $editable = true;
                @endphp
                @livewire('fase-list', ['idEvento' => $evento->id, 'editable' => $editable])

            </div>

        </div>
    </div>

    @include('fasesForm', ['evento' => $evento, 'mifaseUltima' => $mifaseUltima ,'mifaseFinal' => $mifaseFinal])
    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')

</body>

</html>
