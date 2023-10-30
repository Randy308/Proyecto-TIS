<div class="col-lg-8 col-xl-6">
    <div class="card rounded-3">
        <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Formulario de registro de participante</h3>

            <form action='{{ route('registroParticipante.store') }}' method="POST" class="px-md-2"
                enctype="multipart/form-data">
                @csrf
                <div class="form-outline mb-4">
                    <label class="form-label" for="formName">Nombre completo</label>
                    <input type="text" id="formName" class="form-control" name="name"
                        class="@error('name') is-invalid @enderror" />
                    @error('name')
                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">

                        <div class="form-outline datepicker">
                            <label for="formBirthDate" class="form-label">Fecha de
                                nacimiento</label>
                            <input type="date" class="form-control" id="formBirthDate" name="fecha_nac"
                                class="@error('fecha_nac') is-invalid @enderror" />

                            @error('fecha_nac')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="formFile" class="form-label">Foto de perfil</label>
                        <input class="form-control form-control-sm hidden" name="foto_perfil" type="file"
                            id="formFile" ngf-pattern="'image/*'" accept="image/*" ngf-max-size="2MB" hidden>

                        <br>
                        <label id="file-input-label" class="form-control form-control" for="formFile"
                            style="cursor:pointer;">Seleccione una imagen</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">

                            <label for="formEmail" class="form-label">Correo electronico</label>
                            <input type="email" id="formEmail" class="form-control" name="email"
                                class="@error('email') is-invalid @enderror" />
                            @error('email')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">

                        <label class="form-label" for="formInstitucion">Seleccione su Pais de origen</label><br>
                        <select class="form-control form-control" class="form-select" name="pais"
                            id="formInstitucion">
                            <option value="1" disabled>Pais</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Chile">Chile</option>
                            <option value="Peru">Peru</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Brasil">Brasil</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Otra">Otra</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">

                        <div class="form-outline datepicker">
                            <label for="formPhoneNumber" class="form-label">Telefono</label>
                            <input type="tel" id="formPhoneNumber" name="telefono" class="form-control"
                                class="@error('telefono') is-invalid @enderror" />


                            @error('telefono')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror

                        </div>

                    </div>
                    <div class="col-md-6 mb-4">

                        <label class="form-label" for="formInstitucion">Seleccione su Institucion</label><br>
                        <select class="form-control form-control" class="form-select" name="institucion"
                            id="formInstitucion">
                            <option value="1" disabled>Instituciones</option>
                            @if ($instituciones)
                                @foreach ($instituciones as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre_institucion }}</option>
                                @endforeach
                            @else
                                <option value="Otros" disabled>No existen instituciones</option>


                            @endif
                        </select>
                    </div>
                </div>
                
                <div class="form-outline mb-4">
                    <label class="form-label" for="formAddressLocation">Direccion de domicilio</label>
                    <input type="text" id="formAddressLocation" class="form-control" name="direccion"
                        class="@error('direccion') is-invalid @enderror" />
                    @error('direccion')
                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                    @enderror

                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="textAreaHistorial">Historial Academico</label>
                    <textarea id="textAreaHistorial" class="form-control" name="historial" class="@error('historial') is-invalid @enderror"
                        cols="30" rows="3"></textarea>

                    @error('historial')
                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                    @enderror

                </div>
                <div class="form-outline">
                    <label class="form-label" for="password">Contraseña</label>
                    <div class="input-group mb-3">
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
                    <div class="input-group mb-3">

                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control form-control"
                            class="@error('password_confirmation') is-invalid @enderror" />
                        <span class="input-group-text">
                            <i class="far fa-eye" id="secondToggle" style="cursor: pointer;"></i></span>

                    </div>
                    @error('password_confirmation')
                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                    @enderror
                </div><br>

                <a type="button" href="{{ route('index') }}" class="btn btn-secondary btn-lg mb-1">Regresar</a>
                <button type="submit" class="btn btn-primary btn-lg mb-1">Crear usuario</button>

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
