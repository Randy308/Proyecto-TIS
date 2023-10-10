<!DOCTYPE html>
<html lang="es">

<head>
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
