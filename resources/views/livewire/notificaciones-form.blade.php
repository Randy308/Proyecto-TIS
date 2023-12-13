<div>

    
    <form wire:submit.prevent="crearNotificaciones">
        @csrf

        <div class="modal fade" wire:ignore.self id="notificarModal{{$evento->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="false  ">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <center>Notificar a los usuario asociados al evento</center>
                        </h5>
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="asunto">Asunto:</label>
                            <input type="text" class="form-control" wire:model="asunto">
                            @error('asunto')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="descripcion_fase">Detalle:</label>
                            <textarea class="form-control" id="detalle" wire:model="detalle" rows="4" ></textarea>
                            @error('detalle')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            
                                <label>Roles Destinatarios:</label><br>

                                @foreach ($roles as $index =>$rol)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="destinatario{{$index}}"      wire:click="actualizarSeleccionados({{$index}})" >
                                    <label class="form-check-label" for="destinatario{{$index}}">{{$rol->name}}</label>
                                </div>
                                @endforeach
                                @error('seleccionados')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            
                        </div>
    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="botonNotificacionesEnviar{{$evento->id}}" class="btn btn-primary">Enviar</button>
                    </div>
    
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).on('click', '#modalNotificarButton{{$evento->id}}',  function(){
               $('#notificarModal{{$evento->id}}').modal('show');
       });
   </script>
   
</div>


