<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de participante</title>
    @include('layouts/estilos')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="wrapper">
       
        <div id="content">


            <div class="container-sm mt-4">


                @if (session('status'))
                    <div class="alert alert-success">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                <div class="d-flex  justify-content-center align-items-center h-100">
                    @include('layouts.participante-form')
                </div>


            </div>
        </div>
    </div>


    @include('layouts/sidebar-scripts')
</body>

</html>
