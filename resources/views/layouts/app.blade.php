<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        
        .navbar-custom {
            background-color: #007BFF; 
            color: #fff; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="/">INICIO</a>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
