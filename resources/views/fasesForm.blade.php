<form action="{{ route('faseStore', $evento->id) }}" method="POST">
    @csrf
    @php

    @endphp
    <div class="modal fade" id="fasesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <center>formulario de fase</center>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre_fase">Nombre de la fase:<span
                            class="text-danger font-weight-bold ">*</span></label>
                        <input type="text" class="form-control" id="nombre_fase" name="nombre_fase" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion_fase">Descripción de la fase:<span
                            class="text-danger font-weight-bold ">*</span></label>
                        <textarea class="form-control" id="descripcion_fase" name="descripcion_fase" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" class="form-control" id="tipo" required>
                            <option value="General"> General</option>
                            <option value="Calificacion"> Calificacion</option>

                        </select>
                    </div>



                        @if ($mifaseUltima)
                            <div class="form-group">
                                <label for="fechaInicio">Fecha de inicio:</label>
                                <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio"
                                    min="{{ \Carbon\Carbon::parse($mifaseUltima->fechaFin)->addMinutes(5) }}"
                                    max="{{ \Carbon\Carbon::parse($mifaseFinal->fechaInicio)->subMinutes(5) }}"
                                    value="{{ \Carbon\Carbon::parse($mifaseUltima->fechaFin)->addMinutes(15) }}" required>
                            </div>
                        @endif


                        @if ($mifaseFinal)
                            <div class="form-group">
                                <label for="fechaFin">Fecha de fin:</label>
                                <input type="datetime-local" class="form-control" id="fechaFin" name="fechaFin"
                                min="{{ \Carbon\Carbon::parse($mifaseUltima->fechaFin)->subMinutes(5) }}"
                                max="{{ \Carbon\Carbon::parse($mifaseFinal->fechaInicio)->subMinutes(5) }}"
                                    value="{{ \Carbon\Carbon::parse($mifaseFinal->fechaInicio)->subMinutes(15) }}" required>
                            </div>
                        @endif




                    <div class="col d-flex"> <span class="text-danger font-weight-bold ">* Indica que el campo
                            es obligatorio</span></div>        
                    <div class="d-flex flex-column">
                        
                        <button type="submit" id="botonfases" class="btn btn-primary">Crear</button>

                    </div>

                </div>


            </div>
        </div>
    </div>
</form>
