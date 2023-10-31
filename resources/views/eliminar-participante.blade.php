<div class="modal fade" id="eliminarParticipanteModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="eliminarParticipanteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarParticipanteModalLabel">Eliminar Participante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <!-- Aquí puedes incluir el formulario de eliminación -->
                
                <form method="POST" action="{{ route('eliminar-participante',['user_id' => $user->id, 'evento_id' => $evento->id]) }}">
                    @method('DELETE')
                    @csrf
                    <p>¿Estás seguro de que deseas eliminar a {{ $user->name }}?</p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>


