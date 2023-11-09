<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    @include('layouts/estilos')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/auspiciadores.css') }}">

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="d-flex justify-content-center align-items-center container">
                <div class="card py-5 px-3">
                    <h5 class="m-0 d-flex justify-content-center mb-3">Agregar Auspiciadores</h5>
                    <span class="mobile-text">Ingrese el nombre del auspiciador y su respectiva <b
                            class="text-danger">imagen</b></span>
                    <form action='{{ route('auspiciador.store') }}' method="POST" class="px-md-2"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nombre del auspiciador</label>
                                <input type="name" name="nombre" class="form-control" id="exampleFormControlInput1"
                                    placeholder="ingrese el nombre de su auspiciador">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nombres</label>
                                <input type="name" class="form-control" id="recipient-input"
                                    placeholder="ingrese el nombre de su auspiciador">
                                <button type="button" onclick="addRecipient()">Agregar</button>
                            </div>
                            <div id="recipient-list" class="d-flex">
                                
                            </div>
                            <div class="mb-3">
                                <label for="file-auspiciadores" class="form-label">Imagen del auspiciador</label>
                                <input id="file-auspiciadores" name="url" type="file" accept="image/*" />

                            </div>
                            <div class="mb-4 d-flex justify-content-center">
                                <img class="img-prewiew" id="image-preview" src="/storage/image/default_user_image.png"
                                    alt="Previsualización de la imagen" style="height: 150px;margin: 0 auto;">
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <button class="btn btn-danger">Guardar</button>
                        </div>
                    </form>

                </div>
            </div>


        </div>

    </div>

    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    <script>
        document.getElementById("file-auspiciadores").addEventListener("change", function() {
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
        function addRecipient() {
            const input = document.getElementById("recipient-input");
            const recipientList = document.getElementById("recipient-list");

            if (input.value.trim() === "") {
                return;
            }

            const recipient = document.createElement("div");
            recipient.classList.add("recipient");

            const recipientName = document.createElement("span");
            recipientName.textContent = input.value;

            const closeButton = document.createElement("span");
            closeButton.classList.add("close-button");
            closeButton.textContent = "x";
            closeButton.addEventListener("click", function() {
                recipientList.removeChild(recipient);
            });

            recipient.appendChild(recipientName);
            recipient.appendChild(closeButton);
            recipientList.appendChild(recipient);

            input.value = "";
        }
    </script>
</body>

</html>
