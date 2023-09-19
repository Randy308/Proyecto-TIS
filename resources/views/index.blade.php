<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <h1>Lorem</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro laborum nemo consequuntur, aperiam dolores cum?
        Quibusdam cum reiciendis, ullam iure nulla quos quae architecto quidem repudiandae nemo quasi accusantium
        minus?Quaerat, nesciunt minima repellat eum quibusdam quam assumenda nulla provident explicabo neque maxime
        ipsum deserunt voluptatibus aspernatur eveniet itaque sequi reiciendis nisi adipisci vero aliquid expedita est
        excepturi. Unde, tempore!</p>

    <?php
    try {
        \DB::connection()->getPDO();
        echo "Nombre de la base de datos: " .\DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        echo 'No existe conexion';
    }
    ?>
</body>

</html>
