<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @include('layouts/estilos')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
        integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                @php
                $seraFaseAct = \App\Models\FaseEvento::where('evento_id', $evento->id)
                    ->where('actual', 1)
                    ->first();

                date_default_timezone_set('America/La_Paz');
                $fechaHoraActual = date('Y-m-d H:i:s');

                if ($seraFaseAct) {
                    if ($seraFaseAct->fechaFin < $fechaHoraActual) {
                        if ($seraFaseAct->secuencia == 1000) {
                            $eventoEste = \App\Models\Evento::find($evento->id);
                            $eventoEste->estado = 'Finalizado';
                            $eventoEste->save();
                        } else {
                            $seraFaseSig = \App\Models\FaseEvento::where('evento_id', $evento->id)
                                ->where('secuencia', '>', $seraFaseAct->secuencia)
                                ->orderBy('secuencia')
                                ->first();
                            $seraFaseAct->actual = 0;
                            $seraFaseAct->save();
                            $seraFaseSig->actual = 1;
                            $seraFaseSig->save();
                        }
                    }
                }
            @endphp
                @include('plantilla-uno')

            </div>


        </div>

    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    @livewireScripts
    {{-- js de ubicacion y API googleMaps --}}
    <script src="{{ asset('js/ubicacion-mapa-vista.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHfE5-hGkrVMcsw7p6rA4AQR-r1WU3tZY&libraries=places&callback=iniciarMapa">
    </script>


    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script>
        function getColor() {
            return (
                "hsl(" +
                360 * Math.random() +
                "," +
                (25 + 70 * Math.random()) +
                "%," +
                (85 + 10 * Math.random()) +
                "%)"
            );
        }

        function aplicarColor(id) {
            var value = getColor();
            $(id).css("background-color", value);
        }

        function aplicarMiColor(elemento) {
            var value = getColor();
            elemento.css("background-color", "#F9F9F9");
        }
        $(document).ready(function() {
            $("#tipo_evento").selectmenu({
                change: function(event, data) {
                    aplicarColor(".card")
                },
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            var tarjetas = $('.miCard');
            var tarjeta = $('#participantesContainer');
            aplicarMiColor($(tarjeta));
            tarjetas.each(function() {
                aplicarMiColor($(this));
            });
        });
    </script>
</body>

</html>
