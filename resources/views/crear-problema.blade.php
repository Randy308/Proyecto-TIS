<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Problemas</title>
    @include('layouts/estilos')
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
            <div class="container mt-4">
                @livewire('crear-problem',['eventoId' => $id])
            </div>



        </div>
    </div>

    @include('layouts/sidebar-scripts')
    @livewireScripts

    {{-- <script>
        $("#BottonFiltrado").on("click", function() {
            $("#filtrosEvento").toggleClass('FiltroInvisible');
        });
    </script> --}}
</body>

</html>
