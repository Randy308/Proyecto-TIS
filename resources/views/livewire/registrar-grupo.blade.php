<div>
    @php
        $registroExistente1 = \App\Models\Grupo::where('user_id', auth()->user()->id)
                                                ->where('evento_id', $evento_id)
                                                ->first();
    @endphp
    @if ($registroExistente1)
        <span class="text-center alert alert-success">Grupo: {{$registroExistente1->nombre}}</span>
    @else
        <button class="btn btn-primary" wire:click="$set('showModal',true)">Registrar Grupo</button>
        @if ($showModal)
            <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; bottom: 0; left: 0; right: 0;">
                <div style="background: white; width:80%; padding: 20px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <!-- Contenido del modal $showModal true -->
                    <h2>Registrar Grupo</h2>
                    <div class="d-flex px-2">
                        <label class="m-0 py-2" style="width:20%;" for="grupoInput">Nombre de Grupo:</label>
                        <input class="w-100" type="text" wire:model="nombre"  id="grupoInput" placeholder="Ingresa el nombre del grupo">
                        @error('nombre')
                            <span class="text-danger small">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    
                    <h5 class="py-2 my-2">Registrar miembros del grupo:</h5>
                    <div class="px-2">
                        <div class="d-flex mb-3">
                            <div class="py-2 mr-2" style="width:10%;">Mi persona:</div>
                            <input style="width:40%;" type="text" wire:model.defer="nombre1" placeholder="Nombre Completo" required>
                            <input style="width:24%;" type="text" wire:model.defer="email1" placeholder="Email" required>
                            <input style="width:11%;" type="text" wire:model.defer="telefono1" placeholder="Telefono" required>
                            <input style="width:15%;" type="text" wire:model.defer="fechaNacimiento1" placeholder="Fecha Nacimiento" required>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="py-2 mr-2" style="width:10%;">Miembro n°1:</div>
                            <input style="width:40%;" type="text" wire:model.defer="nombre2" placeholder="Nombre Completo" required>
                            <input style="width:24%;" type="text" wire:model.defer="email2" placeholder="Email" required>
                            <input style="width:11%;" type="text" wire:model.defer="telefono2" placeholder="Telefono" required>
                            <input style="width:15%;" type="text" wire:model.defer="fechaNacimiento2" placeholder="Fecha Nacimiento" required>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="py-2 mr-2" style="width:10%;">Miembro n°2:</div>
                            <input style="width:40%;" type="text" wire:model.defer="nombre3" placeholder="Nombre Completo" required>
                            <input style="width:24%;" type="text" wire:model.defer="email3" placeholder="Email" required>
                            <input style="width:11%;" type="text" wire:model.defer="telefono3" placeholder="Telefono" required>
                            <input style="width:15%;" type="text" wire:model.defer="fechaNacimiento3" placeholder="Fecha Nacimiento" required>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="py-2 mr-2" style="width:10%;">Miembro n°3:</div>
                            <input style="width:40%;" type="text" wire:model.defer="nombre4" placeholder="Nombre Completo" required>
                            <input style="width:24%;" type="text" wire:model.defer="email4" placeholder="Email" required>
                            <input style="width:11%;" type="text" wire:model.defer="telefono4" placeholder="Telefono" required>
                            <input style="width:15%;" type="text" wire:model.defer="fechaNacimiento4" placeholder="Fecha Nacimiento" required>
                        </div>                
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-secondary mr-5" wire:click="$set('showModal',false)">Cerrar</button>
                        <button class="btn btn-primary" wire:click="save">Guardar</button>
                    </div>
                </div>
            </div>
        @endif    
    @endif
</div>
