<div class="col-lg-8 col-xl-6">
    <div class="card rounded-3">
        <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Formulario de registro de participante</h3>

            <form action='{{ route('registroParticipante.store') }}' method="POST" class="px-md-2"
                enctype="multipart/form-data">
                @csrf
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1q">Nombre completo</label>
                    <input type="text" id="form3Example1q" class="form-control" name="name"
                        class="@error('name') is-invalid @enderror" />
                    @error('name')
                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">

                        <div class="form-outline datepicker">
                            <label for="exampleDatepicker1" class="form-label">Fecha de
                                nacimiento</label>
                            <input type="date" class="form-control" id="exampleDatepicker1" name="fecha_nac"
                                class="@error('fecha_nac') is-invalid @enderror" />

                            @error('fecha_nac')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="formFile" class="form-label">Foto de perfil</label>
                        <input class="form-control form-control-sm hidden" name="foto_perfil" type="file" id="formFile"  ngf-pattern="'image/*'" accept="image/*" ngf-max-size="2MB" hidden >

                        <br>
                        <label id="file-input-label" for="formFile" style="cursor:pointer;">Seleccione una imagen</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">

                        <div class="form-outline datepicker">
                            <label for="exampleDatepicker1" class="form-label">Telefono</label>
                            <input type="tel" id="form3Example1q" name="telefono" class="form-control"
                                class="@error('telefono') is-invalid @enderror" />


                            @error('telefono')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror

                        </div>

                    </div>
                    <div class="col-md-6 mb-4">

                        <label class="form-label" for="form3Example1q">Seleccione Carrera</label><br>
                        <select class="form-select" class="form-select" name="carrera">
                            <option value="1" disabled>Carrera</option>
                            <option value="Sistemas">Sistemas</option>
                            <option value="Informatica">Informatica</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">

                    <label for="exampleDatepicker1" class="form-label">Correo electronico</label>
                    <input type="email" id="form3Example1q" class="form-control" name="email"
                        class="@error('email') is-invalid @enderror" />
                    @error('email')
                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                    @enderror
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1q">Direccion de domicilio</label>
                    <input type="text" id="form3Example1q" class="form-control" name="direccion"
                        class="@error('direccion') is-invalid @enderror" />
                    @error('direccion')
                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                    @enderror

                </div>
                <div class="form-outline">
                    <label class="form-label" for="form3Example1w">Contraseña</label>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control form-control-lg"
                            class="@error('password') is-invalid @enderror" />
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
                            class="form-control form-control-lg"
                            class="@error('password_confirmation') is-invalid @enderror" />
                        <span class="input-group-text">
                            <i class="far fa-eye" id="secondToggle" style="cursor: pointer;"></i></span>

                    </div>
                    @error('password_confirmation')
                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                    @enderror
                </div><br>


                <button type="submit" class="btn btn-success btn-lg mb-1">Crear usuario</button>

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
