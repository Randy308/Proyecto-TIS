<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @include('layouts/estilos')
    <link rel="stylesheet" href="{{ asset('css/recupera-cuenta.css') }}">
</head>

<body>


    @if (session('status'))
        <div class="alert alert-success">
            <strong>{{ session('status') }}</strong>
        </div>
    @endif

    <div class="container mt-5 p-4" id="miContenedor">
        <div class="d-flex justify-content-end"><a href="{{ route('index') }}" id="btnSalir" class="btn btn-danger btn-sm"><i
                    class="bi bi-x-lg"></i></a></div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-8">

                <h1 id="register">Recuperar Cuenta</h1>
                <div class="all-steps" id="all-steps">
                    <span class="step step-completed"><i class="bi bi-person-circle"></i></span>
                    <span class="step step-completed"><i class="bi bi-send-exclamation-fill"></i></span>
                    <span class="step"><i class="bi bi-shield-lock-fill"></i></span>
                </div>


                <form action="{{ route('actualizar-password') }}" method="post">
                    @csrf
                    <div class="tab" style="display:block;">
                        <h4>Restablecer la Contraseña</h4>
                        <h6>Ingrese el código de confirmación que le enviamos a su correo electrónico y establezca una
                            nueva contraseña para su cuenta.</h6>
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1w">Código de confirmación</label>
                            <div class="input-group mb-3">
                                <input placeholder="ingrese el codigo de confirmacion..."
                                    class="form-control form-control" name="token"
                                    class="@error('token') is-invalid @enderror">

                            </div>
                            @error('token')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>


                        <input type="hidden" name="email" id="emailConfirmation"
                            value="{{ base64_decode(Request::get('email')) }}">


                        <div class="form-outline">
                            <label class="form-label" for="form3Example1w">Contraseña</label>
                            <div class="input-group mb-3">
                                <input type="password" name="password" id="password" class="form-control form-control"
                                    class="@error('password') is-invalid @enderror"
                                    placeholder="Ingrese su nueva contraseña" />
                                <span class="input-group-text">
                                    <i class="far fa-eye" id="firstToggle" style="cursor: pointer;"></i></span>

                            </div>
                            @error('password')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror

                        </div>

                        <div class="form-outline">
                            <label class="form-label" for="form3Example1w">Confirmar Contraseña</label>
                            <div class="input-group mb-3">

                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control form-control"
                                    class="@error('password_confirmation') is-invalid @enderror"
                                    placeholder="Confirme su nueva contraseña" />
                                <span class="input-group-text">
                                    <i class="far fa-eye" id="secondToggle" style="cursor: pointer;"></i></span>

                            </div>
                            @error('password_confirmation')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                    </div>




                    <div style="overflow:auto;" id="nextprevious">
                        <div class="buttonsgroup" style="float:right;">
                            <button type="submit" id="nextBtn"><i class="bi bi-floppy-fill"></i> Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts/sidebar-scripts')
    <script>
        const firstToggle = document.querySelector('#firstToggle');
        const secondToggle = document.querySelector('#secondToggle');
        const password = document.querySelector('#password');
        const password_confirmation = document.querySelector('#password_confirmation');
        firstToggle.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

        secondToggle.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password_confirmation.getAttribute('type') === 'password' ? 'text' : 'password';
            password_confirmation.setAttribute('type', type);

            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    <script>
        document.getElementById("btnSalir").addEventListener("click", function(event) {
            // Mostrar el cuadro de diálogo de confirmación
            var confirmacion = confirm("¿Estás seguro de abandonar la página? El proceso de recuperación de cuenta está en progreso y el token ya fue enviado.");

            // Si el usuario hace clic en "Aceptar" en el cuadro de diálogo, redirige
            if (!confirmacion) {
                event.preventDefault(); // Cancela la acción predeterminada (en este caso, la redirección)
            }
        });
    </script>
</body>

</html>
