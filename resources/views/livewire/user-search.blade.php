<div>
    <input wire:model="email" type="text" placeholder="Ingrese el email">
    <button class="btn btn-sm btn-primary" wire:click="search">Agregar Participante</button>

    @if ($error)
        <div class="p-4 my-2"> <span class="alert alert-danger" role="alert">{{ $error }}</span></div>
    @endif

    @if ($users && $users->count())
        <div class="card">
            <p class="h6">Cantidad de usuario restantes: {{ 4 - $this->users->count() }}</p>
        </div>
        @foreach ($users as $user)
            <div class="card py-4 my-4">
                <div class="row p-4">
                    <div class="col-md-3">
                        <label>Nombre completo</label>
                        <input class="form-control" type="text" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>Email</label>
                        <input class="form-control" type="text" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label>Telefono</label>
                        <input class="form-control" type="text" value="{{ $user->telefono }} " readonly>
                    </div>

                    @if ($loop->first)
                    @else
                        @if ($requiereCodSis == true)
                            <div class="col-md-3">
                                <label>Codigo Estudiante</label>
                                <input class="form-control" type="text" value="{{ $user->cod_estudiante }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label>Universidad</label>
                                <input class="form-control" type="text"
                                    value="{{ $user->institucion->nombre_institucion }}" readonly>
                            </div>
                        @endif

                        <div class="col-md-3">
                            <label>Carrera</label>
                            <input class="form-control" type="text" placeholder="carrera">
                        </div>
                    @endif

                </div>
                @if ($loop->first)
                    @else
                        <div class="col-md-3 d-flex align-items-end justify-content-center">
                            <button class="btn btn-sm btn-danger" wire:click="removeUser({{ $loop->index }})">Quitar
                                usuario</button>
                        </div>
                    @endif

            </div>
        @endforeach

    @endif
</div>
