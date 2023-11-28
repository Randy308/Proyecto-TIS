<!DOCTYPE html>
<html lang="es">

<head>
    <title>Editar Perfil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts/estilos')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/roles-script.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/roles-stilos.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="container-sm mt-4">
                <div class="card">
                    <div class="card-body" id="CardContainer">

                       @include('layouts.user-edit-form')
                    </div>



                </div>
            </div>

        </div>

    </div>
    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    <script>
        document.getElementById("formFile").addEventListener("change", function() {
            const fileInput = this;
            const imagePreview = document.getElementById("image-preview");

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                };

                reader.readAsDataURL(fileInput.files[0]);
            } else {
                // Cuando no se selecciona un archivo, muestra la imagen predeterminada
                imagePreview.src = "/storage/image/default_user_image.png";
                imagePreview.style.display = "block";
            }
        });
    </script>
        <script>
            function myFunction(x) {
                if (x.matches) { // If media query matches
                    //document.body.style.backgroundColor = "yellow";
                    $( "#cardImagen" ).removeClass( "card-body" );
                    $( "#cardDatos" ).removeClass( "card-body" );
                    $( "#CardContainer" ).removeClass( "card-body" );
                    //$( "#miContainer" ).removeClass( "p-5" );
                    //$( "#miContainer" ).removeClass( "m-5" );
                } else {

                    // $( "#miContent" ).addClass( "p-5" );
                    $( "#cardImagen" ).addClass( "card-body" );
                    $( "#cardDatos" ).addClass( "card-body" );
                    $( "#CardContainer" ).addClass( "card-body" );
                }
            }

            var x = window.matchMedia("(max-width: 700px)")
            myFunction(x) // Call listener function at run time
            x.addListener(myFunction) // Attach listener function on state changes
        </script>
</body>

</html>
