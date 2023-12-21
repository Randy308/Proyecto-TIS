<div style="position:fixed;top:0;right:0;bottom:0;left:0;z-index:1050;overflow:hidden;outline:0">

    <div class="modal-dialog">
        
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Crear Problema</h5>
                <button type="button" class="close" wire:click="openModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-outline mb-4">
                    <label class="form-label">Nombre de la Problema<span
                            class="text-danger font-weight-bold ">{{-- * --}}</span></label>
                    <input type="text" id="formName" class="form-control" name="nombre"
                        class="@error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" />
                    
                </div>
                <div class="form-outline mb-4">
                    <label for="descripcion_problema">Descripcion del Problema</label>
                    <textarea type="text" name="descripcion_problema"
                        class="form-control @error('descripcion_problema') is-invalid @enderror" id="descripcion_problema"
                        aria-describedby="descripcion_problema_help" placeholder="Ingrese la descripcion del problema"
                        style="width: 100%; max-height: 190px;height: 180px;">{{ old('descripcion_problema') }}</textarea>
                    
                </div>
                <div class="form-outline mb-4">
                    <label for="estado">Asignar a Fase :</label>
                    <select  id="estado" wire:model="estadoSeleccionado" class="form-select form-control">
                        <option value="" selected>No existen Fases</option>
                        <option value="Borrador">fase1</option>
                        
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="openModal">Cerrar</button>
                <button type="button" class="btn btn-primary">Crear nuevo Problema</button>
            </div>
        </div>
    </div>

</div>
