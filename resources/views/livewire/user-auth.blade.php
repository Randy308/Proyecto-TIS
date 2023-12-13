<div class="container-xl px-4 mt-4">

    <div class="row">
        <div class="col-xl-4">
            <div class="card mb-4 pb-4 mb-xl-0">
                <div class="card-header">Foto de Perfil</div>
                <div class="card-body text-center" id="cardImagen">
                    <!-- Profile picture image-->
                    <div class="thumbnail">
                        <img class="img-thumbnail" src="{{ asset($user->foto_perfil) }}"
                            style="height: 200px;margin: 0 auto;" alt="" title="">
                    </div>
                    <!-- Profile picture upload button-->

                </div>
                <div class="card-footer">
                    <p class="h6">Configuración de usuario</p>
                    <div class="d-flex flex-column wrap-4 justify-content-start align-items-start"
                        id="contenedorBotonesUsuario">

                        <a href="{{ route('editUser', $user->id) }}" class="btn btn-link">Editar cuenta</a>
                        <a href="{{ route('editPassword', $user->id) }}" class="btn btn-link">Cambiar contraseña</a>
                        <a href="{{ route('index') }}" class="btn btn-link">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Datos Personales</div>
                <div class="card-body" id="cardDatos">
                    <ul class="list-group mt-3">
                        <li class="list-group-item"><strong>Roles:</strong>
                            <div id="roles-list" class="d-flex">
                            </div>
                        </li>
                        @php
                            $misRoles = $user->getRoleNames()->toArray();
                        @endphp

                        <script>
                            var misRoles = [];
                            misRoles = @json($misRoles);

                            for (const iterator of misRoles) {
                                agregarRol(iterator);
                            }
                        </script>






                        <li class="list-group-item"><strong>Estado:</strong> <span
                                class="{{ $user->estado == 'Habilitado' ? 'text-success' : 'text-danger' }}">{{ $user->estado }}</span>
                        </li>

                    </ul>

                    <ul class="list-group mt-3">
                        <li class="list-group-item"><strong>Nombre:</strong> {{ $user->name }}</li>
                        <li class="list-group-item"><strong>Correo Electrónico:</strong> {{ $user->email }}</li>
                        <li class="list-group-item"><strong>Teléfono:</strong> {{ $user->telefono }}</li>
                        <li class="list-group-item"><strong>Dirección:</strong> {{ $user->direccion }}</li>
                        <li class="list-group-item"><strong>Universidad:</strong>
                            {{ $user->institucion == null ? 'No existe' : $user->institucion->nombre_institucion }}
                        </li>
                        <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> {{ $user->fecha_nac }}</li>
                        <li class="list-group-item"><strong>Historial Academico:</strong>
                            {{ $user->historial_academico }}</li>
                        @if (auth()->user()->hasRole('usuario común'))
                            <li class="list-group-item"><strong>Codigo de estudiante:</strong>
                                {{ $user->cod_estudiante }}</li>
                        @endif
                    </ul>


                </div>
            </div>
        </div>
    </div>
</div>
