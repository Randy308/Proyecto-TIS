<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts/estilos')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-query.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            @livewire('evento-proximo')
            <footer>
                <p>Laravel {{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
            </footer>
        </div>

    </div>


    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    <script>
        function myFunction(x) {
            if (x.matches) { // If media query matches
                //document.body.style.backgroundColor = "yellow";
                $( "#miContent" ).removeClass( "p-5" );
                $( "#miContent" ).removeClass( "m-5" );
                $( "#miContainer" ).removeClass( "p-5" );
                $( "#miContainer" ).removeClass( "m-5" );
            } else {
                addClass
                $( "#miContent" ).addClass( "p-5" );
                $( "#miContent" ).addClass( "m-5" );
                $( "#miContainer" ).addClass( "p-5" );
                $( "#miContainer" ).addClass( "m-5" );
                //document.body.style.backgroundColor = "pink";
            }
        }

        var x = window.matchMedia("(max-width: 700px)")
        myFunction(x) // Call listener function at run time
        x.addListener(myFunction) // Attach listener function on state changes
    </script>
</body>

</html>
