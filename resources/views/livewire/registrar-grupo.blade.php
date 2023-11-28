<div>
    <h2>Registrar Equipo</h2>
    <div class="d-flex px-2">
        <label class="m-0 py-2" style="width:20%;" for="grupoInput">Nombre del Equipo<span
                class="text-danger">*</span></label>
        <input class="w-100" type="text" wire:model="nombreEquipo" id="grupoInput"
            placeholder="Ingresa el nombre del equipo">
            @error('nombreEquipo')
                <span class=" text-center alert alert-danger small">
                    {{ $message }}
                </span>
            @enderror
    </div>

    <h5 class="py-2 my-2">Registrar integrantes del equipo:</h5>
    <div class="px-2">
        <div class="d-flex mb-3">
            <div class="py-2 mr-2" style="width:10%;">Coach</div>
            <input style="width:25%;" type="text" wire:model.defer="nombre1" placeholder="Nombre Completo" required>
            <input style="width:23%;" type="text" wire:model.defer="email1" placeholder="Correo Electronico" required>
            <input style="width:12%;" type="text" wire:model.defer="telefono1" placeholder="N° telefono" required>
            <input style="width:8%;" type="text" wire:model.defer="institucion1" placeholder="Institucion" required>
            <input style="width:9%;" type="text" wire:model.defer="carrera1" placeholder="Carrera" required>
            <input style="width:13%;" type="text" wire:model.defer="fechaNacimiento1" placeholder="Fecha Nacimiento" required>
        </div>
        <div class="d-flex mb-3">
            <div class="py-2 mr-2" style="width:10%;">Integrante 1</div>
            <input class="@error('nombre2') border-danger @enderror" style="width:25%; height:28px;" type="text" wire:model="nombre2" placeholder="Nombre Completo" required>
            <div class="col m-0 p-0">
                <input class="" style="width:100%" type="text" wire:model="email2" placeholder="Correo Electronico" required>
                <div class=" row m-0 p-0">
                    @error('email2')
                        <span class="text-center alert alert-danger p-1 small">{{ $message }}</span>
                    @enderror
                </div>
            </div>            
            <input class="@error('telefono2') border-danger @enderror" style="width:12%; height:28px;" type="text" wire:model="telefono2" placeholder="Telefono" required>
            <input class="@error('institucion2') border-danger @enderror" style="width:8%; height:28px;" type="text" wire:model="institucion2" placeholder="Institucion" required>
            <input class="@error('carrera2') border-danger @enderror" style="width:9%; height:28px;" type="text" wire:model="carrera2" placeholder="Carrera" required>
            <input class="@error('fechaNacimiento2') border-danger @enderror" style="width:13%; height:28px;" type="text" wire:model="fechaNacimiento2" placeholder="Fecha Nacimiento" required>
        </div>
        @if($error2)
            <div class="row mt-3">
                <div class="col-12">
                    <p class="text-center alert alert-danger small p-2">{{ $error2 }}</p>
                </div>
            </div>
        @endif

        <div class="d-flex mb-3">
            <div class="py-2 mr-2" style="width:10%;">Integrante 2</div>
            <input class="@error('nombre3') border-danger @enderror" style="width:25%; height:28px;" type="text" wire:model="nombre3" placeholder="Nombre Completo" required>
            <div class="col m-0 p-0">
                <input class="" style="width:100%" type="text" wire:model="email3" placeholder="Correo Electronico" required>
                <div class=" row m-0 p-0">
                    @error('email3')
                        <span class="text-center alert alert-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div> 
            <input class="@error('telefono3') border-danger @enderror" style="width:12%;height:28px;" type="text" wire:model="telefono3" placeholder="Telefono" required>
            <input class="@error('institucion3') border-danger @enderror" style="width:8%;height:28px;" type="text" wire:model="institucion3" placeholder="Institucion" required>
            <input class="@error('carrera3') border-danger @enderror" style="width:9%;height:28px;" type="text" wire:model="carrera3" placeholder="Carrera" required>
            <input class="@error('fechaNacimiento3') border-danger @enderror" style="width:13%;height:28px;" type="text" wire:model="fechaNacimiento3" placeholder="Fecha Nacimiento" required>
        </div>
        @if($error3)
            <div class="row mt-3">
                <div class="col-12">
                    <p class="text-center alert alert-danger small p-2">{{ $error3 }}</p>
                </div>
            </div>
        @endif

        <div class="d-flex mb-3">
            <div class="py-2 mr-2" style="width:10%;">Integrante 3</div>
            <input class="@error('nombre4') border-danger @enderror" style="width:25%;height:28px;" type="text" wire:model="nombre4" placeholder="Nombre Completo" required>
            <div class="col m-0 p-0">
                <input class="" style="width:100%" type="text" wire:model="email4" placeholder="Correo Electronico" required>
                <div class=" row m-0 p-0">
                    @error('email4')
                        <span class="text-center alert alert-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div> 
            <input class="@error('telefono4') border-danger @enderror" style="width:12%;height:28px;" type="text" wire:model="telefono4" placeholder="Telefono" required>
            <input class="@error('institucion4') border-danger @enderror" style="width:8%;height:28px;" type="text" wire:model="institucion4" placeholder="Institucion" required>
            <input class="@error('carrera4') border-danger @enderror" style="width:9%;height:28px;" type="text" wire:model="carrera4" placeholder="Carrera" required>
            <input class="@error('fechaNacimiento4') border-danger @enderror" style="width:13%;height:28px;" type="text" wire:model="fechaNacimiento4" placeholder="Fecha Nacimiento" required>
        </div>
    </div>
    @if($error4)
    <div class="row mt-3">
        <div class="col-12">
            <p class="text-center alert alert-danger small p-2">{{ $error4 }}</p>
        </div>
    </div>
@endif

    <div class="d-flex justify-content-center">
        <button class="btn btn-primary" wire:click="save">Registrar Grupo</button>
    </div>
</div>
