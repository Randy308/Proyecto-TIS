<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario</title>
    @include('layouts/estilos')

    <link rel="stylesheet" href="{{ asset('css/plantilla-uno.css') }}" />
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">

            @include('layouts/navbar')
            <div class="container d-flex justify-content-center align-items-center" style="max-width: 100%;">
                <div class="col-lg-8 col-xl-8">
                    <div class="card rounded-3">
                        <div class="card-body p-4 p-md-5">


                            <form action='{{ route('crearUsuario.store') }}' method="POST" class="px-md-2"
                                enctype="multipart/form-data">
                                @csrf
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 text-center">Crear Usuario</h3>

                                <img class="img-prewiew" id="image-preview" src="/storage/image/default_user_image.png"
                                    alt="Previsualización de la imagen" style="width: 200px; height: 200px;">
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="formName">Nombre completo<span
                                                    class="text-danger font-weight-bold ">*</span></label>
                                            <input type="text" id="formName" class="form-control" name="nombre"
                                                class="@error('nombre') is-invalid @enderror"
                                                value="{{ old('nombre') }}" />
                                            @error('nombre')
                                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                            @enderror

                                            <div class="alert alert-danger" role="alert" id="nameCheck">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-outline mb-4">
                                            <label for="formEmail" class="form-label">Correo electronico<span
                                                    class="text-danger font-weight-bold ">*</span></label>
                                            <input type="email" id="formEmail" class="form-control" name="email"
                                                class="@error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" />
                                            @error('email')
                                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                            @enderror

                                            <div class="alert alert-danger" role="alert" id="emailUserCheck">

                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-2">

                                            <label for="formEstado" class="form-label">Estado</label>
                                            <select class="form-control form-control" class="form-select" name="estado"
                                                id="formEstado">
                                                <option value="Habilitado">Habilitado</option>
                                                <option value="Deshabilitado">Deshabilitado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">

                                        <label class="form-label" for="formRol">Rol</label><br>
                                        <select class="form-control form-control" class="form-select" name="rol"
                                            id="formRol">
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 mb-2">

                                        <div class="form-outline datepicker">
                                            <label for="formPhoneNumber" class="form-label">Telefono<span
                                                    class="text-danger font-weight-bold ">*</span></label>
                                            <input type="tel" id="formPhoneNumber" name="telefono"
                                                class="form-control" class="@error('telefono') is-invalid @enderror"
                                                value="{{ old('telefono') }}" />


                                            @error('telefono')
                                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                            @enderror
                                            <div class="alert alert-danger" role="alert" id="telefonoCheck">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-2">

                                        <label class="form-label" for="formInstitucion">Seleccione su
                                            Institucion</label><br>
                                        <select class="form-control form-control" class="form-select" name="institucion"
                                            id="formInstitucion">
                                            <option value="1" disabled>Instituciones</option>
                                            @if ($instituciones)
                                                @foreach ($instituciones as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre_institucion }}</option>
                                                @endforeach
                                            @else
                                                <option value="Otros" disabled>No existen instituciones</option>


                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-outline">
                                            <label class="form-label" for="password">Contraseña<span
                                                    class="text-danger font-weight-bold ">*</span></label>
                                            <div class="input-group mb-2">
                                                <input type="password" name="password" id="password"
                                                    class="form-control form-control"
                                                    class="@error('password') is-invalid @enderror" />
                                                <span class="input-group-text">
                                                    <i class="far fa-eye" id="firstToggle"
                                                        style="cursor: pointer;"></i></span>

                                            </div>
                                            @error('password')
                                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-outline">
                                            <label class="form-label" for="password_confirmation">Confirmar
                                                Contraseña<span class="text-danger font-weight-bold ">*</span></label>
                                            <div class="input-group mb-2">

                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control form-control"
                                                    class="@error('password_confirmation') is-invalid @enderror" />
                                                <span class="input-group-text">
                                                    <i class="far fa-eye" id="secondToggle"
                                                        style="cursor: pointer;"></i></span>

                                            </div>
                                            @error('password_confirmation')
                                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col d-flex"> <span class="text-danger font-weight-bold ">* Indica que
                                            el
                                            campo
                                            es obligatorio</span></div>
                                </div>




                                <div class="pt-4 d-flex justify-content-around">
                                    <a type="button" href="{{ route('listaUsuarios') }}"
                                        class="btn btn-secondary btn-sm mb-1">Regresar</a>
                                    <button type="submit" id="crearUsuarioBoton"
                                        class="btn btn-primary btn-sm mb-1">Crear usuario</button>
                                </div>



                            </form>

                        </div>
                    </div>
                </div>






            </div>


        </div>

    </div>
    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    <script src="{{ asset('js/validaciones-formulario.js') }}"></script>
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
