<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceso Denegado</title>
    @include('layouts/estilos')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>


<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div>
                <h1>Acceso Denegado</h1>
                <p>{{ session('info') }}</p>
                <p><a href="/">Volver al inicio</a></p>
            </div>
        </div>
    </div>
</body>
</html>