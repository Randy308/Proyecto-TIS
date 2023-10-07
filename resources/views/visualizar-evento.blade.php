<!DOCTYPE html>
<html lang="es">

<head>
    <title>Evento</title>
    @include('layouts/estilos')

    <link rel="stylesheet" href="{{ asset('css/plantilla-uno.css') }}" />
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">

            @include('layouts/navbar')
            <div class="container-sm mt-4">

                <div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            <strong>{{ session('status') }}</strong>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                @include('plantilla-uno')

            </div>


        </div>

    </div>
    </div>

    @include('iniciar-sesion')
    @include('layouts/toggle')
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

</body>

</html>
