<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/recupera-cuenta.css') }}">
    @include('layouts/estilos')
</head>

<body>

    @if ($currentTab)
    <script>var currentTab = {{ $currentTab }};</script>
    @else
    <script>var currentTab = 0;</script>
    @endif
    <div class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-8">
                <form id="regForm">
                    <h1 id="register">Recuperar Cuenta</h1>
                    <div class="all-steps" id="all-steps">
                        <span class="step"><i class="bi bi-person-circle"></i></span>
                        <span class="step"><i class="bi bi-send-exclamation-fill"></i></span>
                        <span class="step"><i class="bi bi-shield-lock-fill"></i></span>
                    </div>


                    <div class="tab">
                        <h4>Ingrese su Correo Electrónico</h4>
                        <h6>Por favor, ingrese la dirección de correo electrónico asociada a su cuenta.</h6>
                        @if ($email)
                        <input type="email" placeholder="Ingres su correo electronico vinculado a su cuenta..."
                        oninput="this.className = ''" name="email" id="EmailVinculado" value="{{ $email }}" required>
                        @else
                        <input type="email" placeholder="Ingres su correo electronico vinculado a su cuenta..."
                        oninput="this.className = ''" name="email" id="EmailVinculado" required>
                        @endif


                    </div>
                    <div class="tab">
                        <h4>Confirmación de Correo Electrónico</h4>
                        <h6>Antes de continuar, ¿está seguro de que desea enviar la confirmación a esta dirección?</h6>
                        <span id="spanEmail"></span>


                    </div>
                    <div class="tab">
                        <h4>Restablecer la Contraseña</h4>
                        <h6>Ingrese el código de confirmación que le enviamos a su correo electrónico y establezca una
                            nueva contraseña para su cuenta.</h6>
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1w">Código de confirmación</label>
                            <div class="input-group mb-3">
                                <input placeholder="ingrese el codigo de confirmacion..."
                                    class="form-control form-control" oninput="this.className = ''" name="token">

                            </div>
                        </div>
                        <input type="hidden" name="email" id="emailConfirmation">
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



                    <div class="thanks-message text-center" id="text-message"> <img
                            src="https://i.imgur.com/O18mJ1K.png" width="100" class="mb-4">
                        <h3>Thankyou for your feedback!</h3> <span>Thanks for your valuable information. It helps us to
                            improve our services!</span>
                    </div>
                    <div style="overflow:auto;" id="nextprevious">
                        <div class="buttonsgroup" style="float:right;">
                            <button type="button" id="prevBtn" onclick="nextPrevR(-1)"><i
                                    class="bi bi-arrow-left-circle-fill"></i></button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)"><i
                                    class="bi bi-arrow-right-circle-fill"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/recupera-cuenta.js') }}"></script>
    @include('layouts/sidebar-scripts')
    <script>
        $(document).ready(function() {
            $('#EmailVinculado').on('input', function() {
                var email = $('#EmailVinculado').val();
                console.log("ready!");
                $('#spanEmail').html(email);
                $('#emailConfirmation').val(email);

            });

        });
    </script>
</body>

</html>
