<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    @include('layouts/estilos')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="col py-3">
                <div class="container py-5 h-100">
                    <main>
                        <div>
                            @livewire('role-index')
                        </div>
                    </main>

                </div>
            </div>
        </div>

    </div>



    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
</body>

</html>
