<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{$asunto}}</title>
</head>
<body>
    <h1>Notificacion del evento {{$nombre_evento}}!</h1>
    
    <p>Hola, {{ $user_name }}, los organizadores del evento tiene algo que decirte:</p>
    <h2>{{$asunto}}</h2>
    <p>{{$detalle}}</p>
</body>
</html>