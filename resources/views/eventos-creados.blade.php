<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @include('layouts/estilos')
    @livewireStyles

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">

            @include('layouts/navbar')
            <div class="container-sm mt-4">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $tab == 1 ? 'active' : '' }}" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Eventos
                            activos</button>
                    </li>
                    @can('admin.editar-evento')
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $tab == 2 ? 'active' : '' }}" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Eventos en
                                borrador</button>
                        </li>
                    @endcan


                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $tab == 3 ? 'active' : '' }}" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">Todos mis
                            eventos</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade {{ $tab == 1 ? 'show active' : '' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @livewire('mis-eventos-activos')
                    </div>
                    @can('admin.editar-evento')
                        <div class="tab-pane fade {{ $tab == 2 ? 'show active' : '' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @livewire('eventos-creados')
                        </div>
                    @endcan


                    <div class="tab-pane fade {{ $tab == 3 ? 'show active' : '' }}" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>

            </div>


        </div>




    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
</body>

</html>
