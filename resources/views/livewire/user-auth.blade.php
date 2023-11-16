<div class="container-xl px-4 mt-4">
    
    <div class="row">
        <div class="col-xl-4">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Foto de Perfil</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <div class="thumbnail">
                        <img class="img-thumbnail" src="{{ asset($user->foto_perfil) }}" style="height: 300px;margin: 0 auto;" alt="" title="">
                    </div>
                    <!-- Profile picture upload button-->
                    
                </div>
            </div>
            
        </div>
        <div class="col-xl-8">

            <div class="card mb-4">
                <div class="card-header">Datos Personales</div>
                <div class="card-body">
                    <ul class="list-group mt-3">
                        <li class="list-group-item"><strong>Rol:</strong> {{ $user->getRoleNames()->first() }}</li>
                        <li class="list-group-item"><strong>Estado:</strong> <span class="{{ $user->estado == 'Habilitado' ? 'text-success' : 'text-danger' }}">{{ $user->estado }}</span></li>
                        
                    </ul>

                    <ul class="list-group mt-3">
                        <li class="list-group-item"><strong>Nombre:</strong> {{ $user->name }}</li>
                        <li class="list-group-item"><strong>Correo Electrónico:</strong> {{ $user->email }}</li>
                        <li class="list-group-item"><strong>Teléfono:</strong> {{ $user->telefono }}</li>
                        <li class="list-group-item"><strong>Dirección:</strong> {{ $user->direccion }}</li>
                        <li class="list-group-item"><strong>Universidad:</strong> {{ $user->institucion == null ? 'No existe' : $user->institucion->nombre_institucion }} </li>
                        <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> {{ $user->fecha_nac }}</li>
                        <li class="list-group-item"><strong>Historial Academico:</strong> {{ $user->historial_academico }}</li>
                    </ul>

                    <div class="text-center mt-4">
                        <a href="{{ route('index') }}" class="btn btn-danger mr-2">Volver</a>
                        <a href="{{route('editarUsuario', $user->id)}}" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>