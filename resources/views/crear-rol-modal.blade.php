  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" class="text-center h4">Crear Rol</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form class="mx-1 mx-md-4" action='{{ route('asignarRoles.store') }}' method="POST" h>
                @csrf
              <div class="modal-body">
                      <div class="form-outline">
                          <label class="form-label" for="form3Examplev2">Nombre
                              del rol</label>
                          <input type="text" name="rol" id="rol" class="form-control "
                              class="@error('rol') is-invalid @enderror" />
                          @error('rol')
                              <small>{{ $message }}</small>
                          @enderror

                      </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Crear rol</button>
              </div>
            </form>
          </div>
      </div>
  </div>
