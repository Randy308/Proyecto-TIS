<!-- Modal -->
<div class="modal fade" id="modalRegistroParticipanteEvento" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Registrarse al evento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('registrar-evento-update', ['id' => auth()->user()->id]) }}">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <p class="lead">¿Estás seguro de que deseas participar en este evento?
                    </p>
                    <p class="blockquote-footer">Haz clic en 'Confirmar' para completar tu registro.
                        ¡Esperamos verte en el evento! Si cambias de opinión, puedes cerrar esta ventana.</p>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nombre completo</label>
                            <input type="tel" class="form-control" id="exampleFormControlInput1" value="{{auth()->user()->name  }}" disabled>
                          </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Correo electronico</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" value="{{auth()->user()->email  }}" disabled>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Telefono</label>
                            <input type="tel" class="form-control" id="exampleFormControlInput1" value="{{auth()->user()->telefono  }}" disabled>
                          </div>
                    <input type="hidden" name="evento" value="{{ $evento->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary"> Confirmar</button>
                </div>


            </form>

        </div>
    </div>
</div>
