<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts/estilos')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-query.css') }}">

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="container">
                <div class="col-md-6 offset-md-3 mt-4">
                    <span class="anchor" id="formChangePassword"></span>

                    <!-- form card change password -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0 d-flex align-elements-center">Cambiar contraseña</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('password.update', auth()->user()->id) }}" class="form"
                                role="form">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="inputPasswordOld">Contraseña actual<span
                                            class="text-danger font-weight-bold "> *</span></label>
                                    <div class="input-group mb-2">
                                        <input type="password" name="old_password" class="form-control myPassword"
                                            id="inputPasswordOld" placeholder="Ingrese su contraseña actual" required>
                                        <span class="input-group-text">
                                            <i class="far fa-eye" id="myToogle" style="cursor: pointer;"></i></span>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNew">Nueva contraseña<span
                                            class="text-danger font-weight-bold "> *</span></label>
                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control myPassword" id="inputPasswordNew"
                                            placeholder="*********" name="password" required>
                                        <span class="input-group-text">
                                            <i class="far fa-eye" id="myToogle" style="cursor: pointer;"></i></span>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNewConfirmation">Volver a escribir la nueva contraseña<span
                                            class="text-danger font-weight-bold "> *</span></label>

                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control myPassword"
                                            id="inputPasswordNewConfirmation" placeholder="*********"
                                            name="password_confirmation" required>
                                        <span class="input-group-text">
                                            <i class="far fa-eye" id="myToogle" style="cursor: pointer;"></i></span>

                                    </div>
                                    {{-- <span class="form-text small text-muted">

                                        La contraseña debe tener entre 8 y 20 caracteres y <em>no</em> debe contener
                                        espacios.
                                    </span> --}}
                                </div>
                                <div class="col d-flex"> <span class="text-danger font-weight-bold ">* Indica que el
                                        campo
                                        es obligatorio</span></div>
                                <div class="alert alert-danger" role="alert" id="passwordCheck">

                                </div>
                                <div class="form-group mt-4">
                                    <a type="button" href="{{ route('editarPerfil') }}"
                                        class="btn btn-primary float-left">Regresar</a>
                                    <button type="submit" class="btn btn-success float-right"
                                        id="botonActualizarPassword" disabled>Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form card change password -->

                </div>
            </div>
        </div>

    </div>


    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    <script>
        crearEvento();

        function crearEvento() {
            var passwords = document.querySelectorAll(".myPassword");

            passwords.forEach(function(password) {
                var padre = $(password).closest('.input-group');
                const firstToggle = padre.find('.fa-eye')[0]; // Changed the selector to find the element

                firstToggle.addEventListener('click', function(e) {
                    // toggle the type attribute
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    // toggle the eye slash icon
                    this.classList.toggle('fa-eye-slash');
                });
            });
        }

        function validar(bandera, aviso) {
            if (bandera) {
                $("#passwordCheck").hide();
                $("#passwordCheck").html("");
                $('#botonActualizarPassword').prop("disabled", false);
            } else {
                $("#passwordCheck").show();
                $("#passwordCheck").html(aviso);
                $('#botonActualizarPassword').prop("disabled", true);
            }
        }

        var iguales = false;
        var coincidir = false;
        var minimo = false;
        $('#passwordCheck').hide();

        $(".myPassword").on("input", function() {
            let oldPass = $("#inputPasswordOld").val();
            let newPass = $("#inputPasswordNew").val();
            let confirmPass = $("#inputPasswordNewConfirmation").val();

            if (oldPass == newPass || oldPass == confirmPass) {
                validar(false, "la contraseña nueva debe ser diferente a la actual");
                console.log("Debe introducir una nueva contraseña");
                iguales = false;
            } else {
                iguales = true;
                if (iguales && coincidir && minimo) {
                    validar(true, "");
                }
            }

            if (newPass != confirmPass) {
                coincidir = false;
                validar(false, "Las nuevas contraseñas no coinciden");
                console.log("Las nuevas contraseñas no coinciden");
            } else {
                coincidir = true;
                if (iguales && coincidir && minimo) {
                    validar(true, "");
                }
            }

            if (oldPass.length < 8 || newPass.length < 8 || confirmPass.length < 8) {
                validar(false, "La contraseña debe tener mínimo 8 caracteres");
                minimo = false;
            } else {
                minimo = true;
                if (iguales && coincidir && minimo) {
                    validar(true, "");
                }
            }
        });
    </script>




</body>

</html>
