<!DOCTYPE html>
<html lang="es">

<head>
    
    <title>Editar Evento</title>
    @include('layouts/estilos')
    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listEvent.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-editar-evento.css') }}">
    
    <style>
        .navbar-custom {
            background-color: #007BFF;
            color: #fff;
        }
    </style>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

   
</head>

<body>


    @yield('content')

    
    @include('layouts/toggle')

    <script src="{{ asset('javascript/javascript-editar-evento.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
   

</body>

</html>
