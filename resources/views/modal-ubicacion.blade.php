<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Ubicacion al evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <label for="latitud" class="form-label">Latitud</label>
                <input type="text" readonly class="form-control" name="latitud" id="latitud" value="-17.393921554011527">
                @error('latitud')
                    <small style="color: red">{{ $message }}</small>
                @enderror
                <label for="longitud" class="form-label">Longitud</label>
                <input type="text" readonly class="form-control" name="longitud" id="longitud" value="-66.14727083711682">
                @error('latitud')
                    <small style="color: red">{{ $message }}</small>
                @enderror

                <div class="d-flex m-2">
                    <div id="mapa"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary"  data-dismiss="modal">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
