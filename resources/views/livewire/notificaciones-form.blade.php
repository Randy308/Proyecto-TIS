<div>

    
    <form wire:submit.prevent="espere">
        @csrf
        
        <div class="modal fade" wire:ignore.self id="notificarModal{{$evento->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="false  ">
            <div class="modal-dialog" role="document">
                <div class="modal-content">



                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <center>Notificar a los usuario asociados al evento</center>
                        </h5>
                        <button type="button" class="close" aria-label="Close" wire:click="cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="asunto">Asunto <span
                                class="text-danger font-weight-bold ">*</span>:</label>
                            <input type="text" class="form-control" wire:model="asunto">
                            @error('asunto')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="descripcion_fase">Detalle <span
                                class="text-danger font-weight-bold ">*</span>:</label>
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
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="text-center mb-3"> <!-- Centrar los elementos -->
                            <div class="d-flex justify-content-between"> <!-- Utilizar flexbox para centrar y espaciar los botones -->
                                <button type="button" class="btn btn-danger mr-2" aria-label="Close" wire:click="cerrar">
                                    Cancelar
                                </button>
                                <button type="submit" id="botonNotificacionesEnviar{{$evento->id}}" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                            <p class="mt-3">Espere a que termine el proceso por favor</p> <!-- Texto debajo de los botones -->
                        </div>
                        
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


