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
            </div>


        </div>

        <div>
            <form action="POST" id="form1">
                @csrf
                <input type="hidden" name="id" value="1">
            </form>


        </div>
    </div>

    @include('layouts/toggle')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/home',
                method: 'POST',
                data: {
                    id: 1,
                    _token: $('input[name=_token]').val()
                }
            }).done(function(res) {
                let users = JSON.parse(res);
                console.log(users);
            })


        })
    </script>
</body>

</html>
