<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restablecer contraseña</title>

    @include('layouts/estilos')
    <link rel="stylesheet" href="{{ asset('css/recupera-cuenta.css') }}">
</head>

<body>


    @if (session('status'))
        <div class="alert alert-success">
            <strong>{{ session('status') }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5 p-4" id="miContenedor">
        <div class="d-flex justify-content-end"><a href="{{ route('index') }}" id="btnSalir"
                class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i></a></div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-8">

                <h1 id="register">Restablecer contraseña</h1>
                <div class="all-steps" id="all-steps">
                    <span class="step"><i class="bi bi-person-circle"></i></span>
                    <span class="step"><i class="bi bi-shield-lock-fill"></i></span>
                </div>


                <div class="tabs py-4 my-4">
                    <h4>Ingrese su Correo Electrónico</h4>
                    <h6>Por favor, ingrese la dirección de correo electrónico asociada a su cuenta.</h6>
                    <form action="{{ route('enviar-email') }}" method="POST" id="FormularioEnviarEmail">
                        @csrf
                        @if ($email)
                            <input type="email" placeholder="Ingres su correo electronico vinculado a su cuenta..."
                                oninput="this.className = ''" name="email" id="inputEmail" value="{{ $email }}"
                                required>
                        @else
                            <input type="email" placeholder="Ingres su correo electronico vinculado a su cuenta..."
                                oninput="this.className = ''" name="email" id="inputEmail" required>
                        @endif
                        <div class="alert alert-danger" role="alert" id="usercheck">

                        </div>
                    </form>


                </div>
                <div class="tab py-4 my-4 ">

                </div>

                <div style="overflow:auto;" id="nextprevious">
                    <div class="grupoBotones" style="float:right;">

                        <button type="button" class="btn" id="saveBtn" disabled><i
                                class="bi bi-arrow-right"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>


    @include('layouts/sidebar-scripts')
    <script>
        $(function() {
            // Validate Username
            $("#usercheck").hide();
            let emailError = true;
            let passError = true;

            $("#inputEmail").on("input", function() {
                let regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
                let s = $(this).val();

                if (regex.test(s)) {
                    $("#usercheck").hide();
                    $('#saveBtn').prop("disabled", false);
                    emailError = false;
                } else {
                    $("#usercheck").show();
                    $("#usercheck").html("Email incorrecto");
                    $('#saveBtn').prop("disabled", true);
                    emailError = true;
                }

            });
        });
    </script>
    <script>
        document.getElementById("btnSalir").addEventListener("click", function(event) {
            // Mostrar el cuadro de diálogo de confirmación
            var confirmacion = confirm("¿Estás seguro de que deseas salir?");

            // Si el usuario hace clic en "Aceptar" en el cuadro de diálogo, redirige
            if (!confirmacion) {
                event.preventDefault(); // Cancela la acción predeterminada (en este caso, la redirección)
            }
        });

        

        $("#saveBtn").on("click", function(e) {
            e.preventDefault();
            if (confirm("¿Antes de continuar esta seguro que su cuenta esta vinculada con esta direccion?")) {
                var form = $('#FormularioEnviarEmail');
                console.log('enviando form')
                form.submit();
            }
        });
    </script>
</body>

</html>
