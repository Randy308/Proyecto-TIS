<!-- Modal -->
<form method="POST" action="{{ route('iniciar.sesion.store') }}">
    @csrf
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <center>Bienvenido de nuevo</center>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electronico</label>
                        <input type="email" name="email" class="form-control" id="inputEmail"
                            aria-describedby="emailHelp" placeholder="Ingrese su correo electronico">

                        <div class="alert alert-danger" role="alert" id="usercheck">

                        </div>
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="form3Examplev5">Contraseña</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control form-control"
                                id="inputPassword" placeholder="Ingrese su contraseña" />
                            <span class="input-group-text">
                                <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i></span>

                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <button type="submit" id="botonLogin" class="btn btn-primary" disabled>Acceder</button>

                        <a href="{{ route('recuperar-cuenta') }}" class="btn btn-link">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
                <div class="modal-footer d-flex align-self-center">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> --}}
                    <a href="{{ route('registrar-participante') }}"class="btn btn-success">Crear cuenta nueva</a>
                </div>

            </div>
        </div>
    </div>
</form>
<script src="{{ asset('js/login-form.js') }}"></script>
