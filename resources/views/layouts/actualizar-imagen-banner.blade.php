<div class="modal fade" id="modalSubirBanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('evento.banner.update', ['user' => auth()->user(), 'evento' => $evento]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="modal-body">

                        <label for="fileBanner" class="form-label">Foto del Banner</label>
                        <input class="form-control-lg" name="foto_banner" type="file" id="fileBanner"
                            ngf-pattern="'image/*'" accept="image/*" ngf-max-size="2MB"
                            placeholder="Seleccione la imagen descargada">
                        <div id="preview2">
                            <p class="alert alert-info" id="file-banner-info">No hay archivo
                                aún</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>



            </form>

        </div>
    </div>
</div>
