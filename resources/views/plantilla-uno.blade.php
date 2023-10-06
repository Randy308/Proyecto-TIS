<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/plantilla-uno.css') }}" />
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="content c1">
            <div class="card">
                <div class="contenedor-banner">
                    <img src="{{ asset($evento->direccion_banner) }}" alt="logo-banner" id="miBanner" />
                </div>
                <div class="div-titulo">
                    <div>
                        @php
                            // Establece la configuración regional en español
                            $idEventoPagina = $evento->id;

                            \Carbon\Carbon::setLocale('es');
                        @endphp
                        <h5>Fecha {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d-m-Y \a \l\a\s H:i:s') }}</h5>


                        <h1 id="miTitulo">{{ $evento->nombre_evento }}</h1>
                        <h6>Tipo de evento: <b> {{ $evento->categoria }}</b></h6>
                    </div>
                    <div class="div-btn-registrarse">
                        @guest
                            <button class="btn btn-primary" id="boton-registro">
                                Iniciar Sesion
                            </button>
                        @endguest
                        @auth
                            @php
                                $idEventoPagina = $evento->id;
                                $usuario = auth()->user();
                            @endphp
                            <button class="btn btn-primary" id="boton-registro" onclick="mifuncion()">
                                Registrarse
                            </button>

                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div class="content c3">
            <div class="card">
                <div>
                    <h5>Auspiciadores</h5>
                    <script>
                        function mifuncion() {

                            alert('{{ $usuario->email}}');

                        }
                    </script>
                </div>
            </div>
        </div>
        <div id="content" class="content">
            <div class="tabContainer">
                <ul class="tabs">
                    <li>
                        <a src="tab1" href="javascript:void(0);" class="active">Informacion</a>
                    </li>
                    <li><a src="tab2" href="javascript:void(0);">Publicaciones</a></li>
                </ul>
                <div class="tabContent">
                    <div class="c2" id="tab1">
                        <div class="card" id="card-principal">
                            <div class="card">
                                <h4>Detalles</h4>
                                <p>descripcion</p>
                                <p>{{ $evento->descripcion_evento }}</p>
                                <h5>Estado</h5>
                                <p>{{ $evento->estado }}</p>
                            </div>
                            <div class="card">
                                <h4>Organizador</h4>
                                <p>usuario</p>
                            </div>
                            <div class="card"></div>
                        </div>
                        <div class="card" id="participantesContainer">
                            <div class="card" id="participantes">
                                <h5>Lista de Participantes</h5>


                                @if ($evento->users->count())
                                    @foreach ($evento->users as $user)
                                        <p>{{ $user->name }}</p>
                                    @endforeach
                                @else
                                    <p>No existe participantes</p>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card" id="tab2">
                        <div class="card">
                            <span><b>usuario: </b>mensaje 1 ...</span>
                        </div>
                        <div class="card">
                            <span><b>usuario: </b>mensaje 2 ...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
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

</html>
