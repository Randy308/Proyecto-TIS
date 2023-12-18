<div class="modal fade" id="modalEliminarGrupo" tabindex="-1" role="dialog" aria-labelledby="modalEliminarGrupoLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarGrupoLabel">Eliminar grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('abandonar.grupo', ['evento_id' => $evento, 'grupo_id' => $grupo->id]) }}">
                <div class="modal-body">
                    <p>Esta seguro de retirar su grupo del evento ?</p>
                    <p>En caso volver a participar , debera introducir todos los datos de nuevo</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>

        </div>
    </div>
</div>
