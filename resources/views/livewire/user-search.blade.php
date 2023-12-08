<div>
    <div class="row">
        <div class="col">
            <p class="h5">Registrar Equipo</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-auto">
            <label for="grupoInput">Nombre del Equipo<span class="text-danger">*</span></label>
        </div>
        <div class="col">
            <div class="form-group">

                <input type="text" class="form-control" wire:model="nombreEquipo" id="nombreEquipo"
                    placeholder="Ingrese el nombre del equipo">

                @error('nombreEquipo')
                <script>
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right"
                    }
                    toastr.error("{{ $message }}");
                </script>
                @enderror
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col">
            <p class="h6">Buscar integrantes del equipo:</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <input class="form-control" wire:model="email" type="text" placeholder="Ingrese el email">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" wire:click="search"><i class="bi bi-search"></i> Buscar
                        Participante</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col">
            @if ($error)
                <script>
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right"
                    }
                    toastr.error("{{ $error }}");
                </script>
            @endif
        </div>
    </div>

    @if ($users && $users->count())

        <div class="row py-4">
            <div class="col">
                <p class="h6">Cantidad de integrantes restantes: <span
                        class="text-danger">{{ 4 - $this->users->count() }}</span></p>
            </div>
        </div>
        @foreach ($users as $user)
            <div class="card py-2 p-4">
                <div class="row">
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

                        {{-- <div class="col-md-3">
                            <label>Carrera</label>
                            <input class="form-control" type="text" placeholder="carrera">
                        </div> --}}
                        <div class="py-4 col-md-3 d-flex align-items-end justify-content-center">
                            <button class="btn btn-sm btn-danger" wire:click="removeUser({{ $loop->index }})">Quitar
                                usuario</button>
                        </div>
                        {{-- <div class="col-md-3">
                            <label>Carrera</label>
                            <input class="form-control" type="text" placeholder="carrera">
                        </div> --}}
                    @endif

                </div>

            </div>
        @endforeach
        <div class="row py-4 ">
            <div class="col d-flex justify-content-end">
                @if ($this->users->count() != 4)
                    <button class="btn btn-success btn-sm" type="button" disabled><i class="bi bi-floppy2"></i> Registrar grupo</button>
                @else
                    <button class="btn btn-success btn-sm" wire:click="save"><i class="bi bi-floppy2"></i> Registrar grupo</button>
                @endif
            </div>

        </div>
    @endif


</div>
<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
