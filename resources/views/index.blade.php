<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    @include('layouts/estilos')

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
                <div class="content" id="contenedor">
            </div>


        </div>

        <div>
            <form action="POST" id="form1">
                @csrf
                <input type="hidden" name="id" value="1">
            </form>


        </div>


        </div>
    </div>

    @include('layouts/toggle')
<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
