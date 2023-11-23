<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
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
                    <div class="card-body">

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
</body>

</html>
