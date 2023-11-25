<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evento</title>
    @include('layouts/estilos')

    <link rel="stylesheet" href="{{ asset('css/plantilla-uno.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/ubicacionevento.css') }}">
    @livewireStyles
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">

            @include('layouts/navbar')
            <div class="container mt-4">
                @include('plantilla-uno')

            </div>


        </div>

    </div>
    </div>


    @include('layouts/sidebar-scripts')
    <script>
        $("#content").on("click", ".tabContainer .tabs a", function(e) {
            e.preventDefault(),
                $(this)
                .parents(".tabContainer")
                .find(".tabContent > div")
                .each(function() {
                    $(this).hide();
                });

            $(this).parents(".tabs").find("a").removeClass("active"),
                $(this).toggleClass("active"),
                $("#" + $(this).attr("src")).show();
        });
    </script>
    
    @livewireScripts
    {{-- js de ubicacion y API googleMaps --}}
    <script src="{{ asset('js/ubicacion-mapa-vista.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHfE5-hGkrVMcsw7p6rA4AQR-r1WU3tZY&libraries=places&callback=iniciarMapa">
    </script>
</body>

</html>
