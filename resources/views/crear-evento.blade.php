<form method="POST" action="{{ route('crear-evento-form') }}" enctype="multipart/form-data">
    @csrf

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre_evento" class="col-form-label">Nombre del Evento:</label>
                        <input type="text" name="nombre_evento" class="form-control" id="nombre_evento">
                    </div>
                    <div class="form-group">
                        <label for="descripcion_evento" class="col-form-label">Imagen Banner:</label>
                        <input type="file" name="direccion_banner">
                    </div>
                    <div class="form-group">
                        <label for="descripcion_evento" class="col-form-label">Descripción del Evento:</label>
                        <textarea name="descripcion_evento" class="form-control" id="descripcion_evento"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="estado" class="col-form-label">Estado:</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="estado">
                            <option>activo</option>
                            <option>finalizado</option>
                            <option>cancelado</option>

                          </select>
                    </div>
                    <div class="form-group">
                        <label for="categoria" class="col-form-label">categoria:</label>
                        <input type="text" class="form-control" name="categoria" id="categoria">

                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="fecha_inicio" class="col-form-label">Fecha de inicio:</label>
                            <input type="datetime-local" name="fecha_inicio" class="form-control" id="fecha_inicio">
                        </div>
                        <div class="col">
                            <label for="fecha_fin" class="col-form-label">Fecha de finalización:</label>
                            <input type="datetime-local" name="fecha_fin" class="form-control" id="fecha_fin">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar Evento</button>
                </div>
            </div>

        </div>
    </div>

</form>

