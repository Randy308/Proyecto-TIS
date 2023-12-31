<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Evento</title>
    @include('layouts/estilos')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/listEvent.css') }}">
    <style>
        .navbar-custom {
            background-color: #007BFF;
            color: #fff;
        }

        p {
            color: black;
            font-size: 13px;
        }
    </style>


    @livewireStyles

</head>

<body>


    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="container mt-5">
                <div class="d-flex  justify-content-center">
                    <h3>Listado de Eventos</h2>
                </div>

                @livewire('evento-list')
            </div>



        </div>
    </div>

    @include('layouts/sidebar-scripts')

    <script>
        $("#BottonFiltrado").on("click", function() {
            $("#filtrosEvento").toggleClass('FiltroInvisible');
        });
    </script>
</body>

</html>
