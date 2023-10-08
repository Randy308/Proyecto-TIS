<div class="modal fade" id="abandonarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¡Atención!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>Estás a punto de abandonar el evento. <br>
                Si abandonas el evento, perderás tu inscripción y no podrás participar. <br>
                ¿Estás seguro de que deseas abandonar este evento?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <form action="{{ route('user.delete',['user' => auth()->user() , 'evento' => $evento]) }}" method="post">
            @csrf
            @method('DELETE')           
            <button type="submit" class="btn btn-primary">Abandonar</button>
            </form>
          
        </div>
      </div>
    </div>
  </div>
