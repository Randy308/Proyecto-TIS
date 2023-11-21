<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts/estilos')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="container-sm mt-4">
                <?php
                try {
                    \DB::connection()->getPDO();
                    echo '<strong>Nombre de la base de datos: </strong>' . \DB::connection()->getDatabaseName();
                } catch (\Exception $e) {
                    echo 'No existe conexion';
                }
                ?>
                <hr>
            </div>
            <h5>Laravel {{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</h5>
            @livewire('evento-proximo')
        </div>

    </div>

    <div>
        <form action="POST" id="form1">
            @csrf
            <input type="hidden" name="id" value="1">
        </form>


    </div>

    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
</body>

</html>
