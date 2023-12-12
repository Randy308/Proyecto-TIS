<!-- Modal -->
<div class="modal fade" id="promedioModal" tabindex="-1" role="dialog" aria-labelledby="promedioModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="promedioModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('promedio.grupos.create', ['evento_id'=>$evento_id]) }}" method="POST">
                @csrf
                <div class="modal-body">

                    <p class="h5">Esta seguro que desea completar las calificaciones ?</p>
                    <p class="h6">Una vez completadas ya no se podra crear nuevas calificaciones</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
