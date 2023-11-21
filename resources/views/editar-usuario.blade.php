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
                
                
                            <form action='{{ route('editarUsuario.edit' , $usuario->id) }}' method="POST" class="px-md-2"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 text-center">Editar Usuario</h3>

                                    <img class="img-prewiew" id="image-preview" src="/storage/image/default_user_image.png" alt="Previsualización de la imagen" style="max-width: 100%;margin: 0 auto;">    
                                <br>
                                
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="formName">Nombre completo</label>
                                    <input type="text" id="formName" class="form-control" name="name"
                                        class="@error('name') is-invalid @enderror" value="{{ old('name', $usuario->name) }}" />
                                    @error('name')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                
                                        <div class="form-outline datepicker">
                                            <label for="formBirthDate" class="form-label">Fecha de
                                                nacimiento</label>
                                            <input type="date" class="form-control" id="formBirthDate" name="fecha_nac"
                                                class="@error('fecha_nac') is-invalid @enderror"  value="{{ old('fecha_nac', $usuario->fecha_nac) }}" />
                
                                            @error('fecha_nac')
                                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                            @enderror
                                        </div>
                
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="formFile" class="form-label">Foto de perfil</label>
                                        <input class="form-control form-control-sm" name="foto_perfil" type="file" id="formFile"
                                            ngf-pattern="'image/*'" accept="image/*" ngf-max-size="2MB"
                                            class="@error('foto_perfil') is-invalid @enderror">
                                        @error('foto_perfil')
                                            <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                        @enderror
                
                
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-2">
                
                                            <label for="formEstado" class="form-label">Estado</label>
                                            <select class="form-control form-control" class="form-select" name="estado"
                                            id="formEstado">
                                            <option value="Habilitado" {{$usuario->estado == 'Habilitado' ? 'selected': ''}}>Habilitado</option>
                                            <option value="Deshabilitado" {{$usuario->estado == 'Deshabilitado' ? 'selected': ''}}>Deshabilitado</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                
                                        <label class="form-label" for="formRol">Rol</label><br>
                                        <select class="form-control form-control" class="form-select" name="rol"
                                            id="formRol">
                                            @foreach ($roles as $rol)
                                            <option value="{{$rol->name}}" {{ $usuario->getRoleNames()->first() == $rol->name ? 'selected': ''}}>{{$rol->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-2">
                
                                            <label for="formEmail" class="form-label">Correo electronico</label>
                                            <input type="email" id="formEmail" class="form-control" name="email"
                                                class="@error('email') is-invalid @enderror"  value="{{ old('email', $usuario->email)}}" />
                                            @error('email')
                                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                
                                        <label class="form-label" for="formInstitucion">Seleccione su Pais de origen</label><br>
                                        <select class="form-control form-control" class="form-select" name="pais"
                                            id="formInstitucion">
                                            <option value="1" disabled>Pais</option>
                                            <option value="Bolivia" {{$usuario->pais == 'Bolivia' ? 'selected': ''}}>Bolivia</option>
                                            <option value="Argentina" {{$usuario->pais == 'Argentina' ? 'selected': ''}}>Argentina</option>
                                            <option value="Chile" {{$usuario->pais == 'Chile' ? 'selected': ''}}>Chile</option>
                                            <option value="Peru" {{$usuario->pais == 'Peru' ? 'selected': ''}}>Peru</option>
                                            <option value="Uruguay" {{$usuario->pais == 'Uruguay' ? 'selected': ''}}>Uruguay</option>
                                            <option value="Ecuador" {{$usuario->pais == 'Ecuador' ? 'selected': ''}}>Ecuador</option>
                                            <option value="Colombia" {{$usuario->pais == 'Colombia' ? 'selected': ''}}>Colombia</option>
                                            <option value="Paraguay" {{$usuario->pais == 'Paraguay' ? 'selected': ''}}>Paraguay</option>
                                            <option value="Brasil" {{$usuario->pais == 'Brasil' ? 'selected': ''}}>Brasil</option>
                                            <option value="Venezuela" {{$usuario->pais == 'Venezuela' ? 'selected': ''}}>Venezuela</option>
                                            <option value="Otra"  {{$usuario->pais == 'Otra' ? 'selected': ''}}>Otra</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                
                                        <div class="form-outline datepicker">
                                            <label for="formPhoneNumber" class="form-label">Telefono</label>
                                            <input type="tel" id="formPhoneNumber" name="telefono" class="form-control"
                                                class="@error('telefono') is-invalid @enderror" value="{{ old('telefono', $usuario->telefono) }}" />
                
                
                                            @error('telefono')
                                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                            @enderror
                
                                        </div>
                
                                    </div>
                                    <div class="col-md-6 mb-2">
                
                                        <label class="form-label" for="formInstitucion">Seleccione su Institucion</label><br>
                                        <select class="form-control form-control" class="form-select" name="institucion"
                                            id="formInstitucion">
                                            <option value="1" disabled>Instituciones</option>
                                            @if ($instituciones)
                                                @foreach ($instituciones as $item)
                                                    <option value="{{ $item->id }}" {{ $usuario->institucion_id == $item->id ? 'selected': ''}}>{{ $item->nombre_institucion }}</option>
                                                @endforeach
                                            @else
                                                <option value="Otros" disabled>No existen instituciones</option>
                
                
                                            @endif
                                        </select>
                                    </div>
                                </div>
                
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="formAddressLocation">Direccion de domicilio</label>
                                    <input type="text" id="formAddressLocation" class="form-control" name="direccion"
                                        class="@error('direccion') is-invalid @enderror"  value="{{ old('direccion', $usuario->direccion) }}"/>
                                    @error('direccion')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror
                
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="textAreaHistorial">Historial Academico</label>
                                    <textarea id="textAreaHistorial" class="form-control" name="historial"
                                        class="@error('historial') is-invalid @enderror" cols="30" rows="3" >{{ old('historial', $usuario->historial_academico) }}</textarea>
                
                                    @error('historial')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror
                
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="cambiar-contrasena" name="cambiar_contrasena">
                                    <label class="form-check-label" for="cambiar-contrasena">Cambiar Contraseña</label>
                                </div>
                                <div id="contrasena-fields" style="display: none;">
                                    <div class="form-outline">
                                        <label class="form-label" for="password">Contraseña</label>
                                        <div class="input-group mb-2">
                                            <input type="password" name="password" id="password" class="form-control form-control"
                                                class="@error('password') is-invalid @enderror" />
                                            <span class="input-group-text">
                                                <i class="far fa-eye" id="firstToggle" style="cursor: pointer;"></i></span>
                    
                                        </div>
                                        @error('password')
                                            <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                        @enderror
                    
                                    </div>
                    
                                    <div class="form-outline">
                                        <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                        <div class="input-group mb-2">
                    
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control form-control"
                                                class="@error('password_confirmation') is-invalid @enderror" />
                                            <span class="input-group-text">
                                                <i class="far fa-eye" id="secondToggle" style="cursor: pointer;"></i></span>
                    
                                        </div>
                                        @error('password_confirmation')
                                            <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                        @enderror
                                    </div>

                                </div>
                                
                                <div class="pt-4 d-flex justify-content-around">
                                    <a type="button" href="{{ route('verUsuario', $usuario->id) }}" class="btn btn-secondary btn-lg mb-1">Regresar</a>
                                    <button type="submit" class="btn btn-primary btn-lg mb-1">Editar usuario</button>
                                </div>
                
                
                
                            </form>
                
                        </div>
                    </div>
                </div>
                
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
                

                <script>
                    const cambiarContrasenaCheckbox = document.getElementById('cambiar-contrasena');
                    const contrasenaFields = document.getElementById('contrasena-fields');
                
                    cambiarContrasenaCheckbox.addEventListener('change', function() {
                        if (this.checked) {
                            contrasenaFields.style.display = 'block';
                        } else {
                            contrasenaFields.style.display = 'none';
                        }
                    });
                </script>
                
            </div>


        </div>

    </div>
    @include('layouts/sidebar-scripts')
</body>

</html>


