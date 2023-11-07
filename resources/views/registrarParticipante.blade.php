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

<style>
    body {
        background-color: #003153;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to bottom right,#003153, #0086ff);

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to bottom right, #003153,#0086ff)
    }
</style>

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
</body>

</html>
