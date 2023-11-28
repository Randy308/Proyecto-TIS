
{{$faseActual->nombre_fase}}
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre de la Fase</th>
                                <th>Descripción</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fases as $fase)
                            <tr>
                                <td>{{ $fase->nombre_fase }}</td>
                                <td>{{ $fase->descripcion_fase }}</td>
                                <td>{{ $fase->fechaInicio->format('H:i d/m/Y') }}</td>
                                <td>{{ $fase->fechaFin->format('H:i d/m/Y') }}</td>
                                <td>{{ $fase->tipo }}</td>
                                
                                <td class="alin text-center">
                                    
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#faseModalEdit{{$fase->id}}" >
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    @if( $fase->tipo !== 'Inscripcion' && $fase->tipo !== 'Finalizacion')
                                        <form id="FormularioEli" action="{{ route('fase.delete', $fase->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button id="BotonEliminar"class="btn btn-danger btn-sm" type="submit"><i class="bi bi-trash-fill"></i></button>

                                        </form>
                                    @endif
                                    
                                </td>

                            </tr>
                            <form  action="{{ route('faseEdit', $fase->id ) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal fade" id="faseModalEdit{{$fase->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    <center>Editar la Fase</center>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                            
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nombre_fase">Nombre de la fase:</label>
                                                    <input type="text" class="form-control" id="nombre_fase" name="nombre_fase" required value="{{ old('nombre_fase', $fase->nombre_fase) }}">
                                                </div>
                            
                                                <div class="form-group">
                                                    <label for="descripcion_fase">Descripción de la fase:</label>
                                                    <textarea class="form-control" id="descripcion_fase" name="descripcion_fase" rows="4" required  >{{ old('descripcion_fase', $fase->descripcion_fase) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tipo">Tipo</label>
                                                    <select name="tipo" class="form-control" id="tipo" required {{$fase->tipo == 'Inscripcion' || $fase->tipo == 'Finalizacion'  ? 'disabled': ''}}>
                                                        <option value="General"  {{$fase->tipo == 'General' ? 'selected': ''}}> General</option>
                                                        <option value="Calificacion" {{$fase->tipo == 'Calificacion' ? 'selected': ''}}> Calificación</option>
                                                        <option value="Inscripcion" {{$fase->tipo == 'Inscripcion' ? 'selected': ''}}> Inscripción</option>
                                                        <option value="Finalizacion" {{$fase->tipo == 'Finalizacion' ? 'selected': ''}}> Finalización</option>
                                                    </select>
                                                </div>
                            
                            
                                                <div class="form-group">
                                                    <label for="fechaInicio">Fecha de inicio:</label>
                                                    <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" required value="{{ old('fechaInicio', $fase->fechaInicio->format('Y-m-d\TH:i')) }}">
                                                </div>
                            
                                                <div class="form-group">
                                                    <label for="fechaFin">Fecha de fin:</label>
                                                    <input type="datetime-local" class="form-control" id="fechaFin" name="fechaFin" required value="{{ old('fechaFin', $fase->fechaFin->format('Y-m-d\TH:i')) }}">
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <button type="submit" id="botonfases" class="btn btn-primary" >Editar</button>
                            
                                                </div>
                                                
                                            </div>
                            
                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            @endforeach
                        </tbody>
                    </table>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $("#BotonEliminar").on("click", function(e) {
        e.preventDefault();
        if (confirm("¿Está seguro de eliminar esta fase?")) {
            var form = $("#BotonEliminar").parents('form:first');
            form.submit();
        }
    });
</script>

<script src="{{ asset('js/login-form.js') }}"></script>
