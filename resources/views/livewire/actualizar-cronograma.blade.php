<div class="container-sm mt-4 p-4">
    <form action="{{ route('actualizar.fase.actual', ['evento_id' => $idEvento]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <table class="table table-bordered table-responsive-sm table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th class="tabla-header">Nombre de la fase</th>
                        <th class="tabla-header">Descripción</th>
                        <th class="tabla-header">Fecha de inicio</th>
                        <th class="tabla-header">Fecha de fin</th>
                        <th class="tabla-header">Tipo</th>
                        @if ($editable)
                            <th class="tabla-header">Fase actual</th>
                        @endif


                    </tr>
                </thead>
                <tbody>

                    @foreach ($fases as $fase)
                        <tr
                            @if ($fase->secuencia == $miFaseActual->secuencia) class="table-primary"
                            @elseif ($miFaseActual->secuencia > $fase->secuencia)
                            class="table-active"
                            @else @endif>
                            <td>{{ $fase->nombre_fase }}</td>
                            <td>{{ $fase->descripcion_fase }}</td>
                            <td>{{ $fase->fechaInicio->format('H:i d/m/Y') }}</td>
                            <td>{{ $fase->fechaFin->format('H:i d/m/Y') }}</td>
                            <td>{{ $fase->tipo }}</td>
                            @if ($editable)
                                <th>
                                    <div class="form-check form-switch m-4">
                                        <input class="form-check-input {{ $loop->last ? 'ultimo-checkbox' : '' }}" type="radio" name="exampleRadios"
                                            id="exampleRadios{{ $fase->id }}" value="{{ $fase->id }}"
                                            {{ $fase->actual == 1 ? 'checked' : '' }}
                                            {{ $miFaseActual->secuencia > $fase->secuencia ? 'disabled' : '' }}>
                                    </div>
                                </th>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" id="btn-actualizar" type="submit">Actualizar cronograma</button>
        </div>
    </form>

    <script>
        $("#btn-actualizar").on("click", function(e) {
            e.preventDefault();
    
            // Identificar el último radiobutton marcado
            var ultimoRadiobutton = $(".form-check-input:checked.ultimo-checkbox");
    
            if (ultimoRadiobutton.length > 0) {
                // El último radiobutton está marcado
                var mensaje = "¿Está seguro de actualizar las fases?";
                
                if (ultimoRadiobutton.is(":last-of-type")) {
                    // Es el último radiobutton y es marcado como "final"
                    
                    mensaje += "\nHa selecciona la ultima fase esto procedera a finalizar el evento\nAl finalizar el evento, este no estará disponible para ninguna edición y solo estará disponible en la lista general de eventos.";
                }
    
                if (confirm(mensaje)) {
                    var form = $(this).parents('form:first');
                    form.submit();
                }
            } else {
                // Ningún radiobutton marcado, muestra un mensaje diferente
                alert("Por favor, seleccione una fase antes de actualizar las fases.");
            }
        });
    </script>
    
    
</div>
