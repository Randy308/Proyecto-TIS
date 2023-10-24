<!-- Modal de eliminación de participante -->
<div class="modal fade" id="eliminarParticipanteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Eliminar Participante</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p>¿Estás seguro de que deseas eliminar a este participante?</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <form method="POST" action="{{ route('eliminar-participante', ['user_id' => $user->id,'evento_id' => $evento->id]) }}">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-danger">Eliminar</button>
              </form>
          </div>
      </div>
  </div>
</div>
