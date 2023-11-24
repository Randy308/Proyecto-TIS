<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts/estilos')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @livewireScripts
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">

            @include('layouts/navbar')
            <div class="container-sm mt-4">

                @livewire('eventos-creados')
            </div>


        </div>




    </div>

    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    <script>
        $(document).ready(function() {
        $('#BotonPublicarEvento').on('click', function() {
            //"¿Estás seguro de que deseas Publicar el evento? Una vez publicado los usuario podran interactuar con el evento ."
            if (confirm("¿Estás seguro de que deseas Publicar el evento?."
                )) {
               $('#FormPublicar').submit();
            } else {
                console.log("presionaste Cancel!");
            }
        });
    });
    </script>
</body>

</html>
