<div>

    @if ($eventos->count())
        <h3 class="p-3">Lista de Eventos Creados</h3>
        <div class="card-body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Evento</th>
                        <th>Estado del Evento</th>
                        <th>Tipo de Evento</th>
                        <th>Modalidad</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $evento)
                        <tr>

                            <td>{{ $evento->id }}</td>
                            <td>{{ $evento->nombre_evento }}</td>
                            <td>{{ $evento->estado }}</td>
                            <td>{{ $evento->tipo_evento }}</td>
                            <td>{{ ucwords($evento->modalidad) }}</td>


                            @if (strtoupper($evento->estado) == 'ACTIVO')
                                <td class="d-flex">

                                    <div class="btn-group btn-group-sm" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false" style="width: 140px">
                                            Acción
                                        </button>

                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                            @if (strtoupper($evento->modalidad) == 'GRUPAL')
                                                <li><a class="dropdown-item" href="#">Ver Grupos</a></li>
                                                <li><a class="dropdown-item" href="#">Calificar Grupos</a></li>
                                            @else
                                                <li><a class="dropdown-item"
                                                        href="{{ route('ver.participantes', ['evento_id' => $evento->id]) }}">Ver
                                                        Participantes</a></li>
                                                <li><a class="dropdown-item" href="#">Calificar participantes</a>
                                                </li>
                                            @endif
                                            <li><a class="dropdown-item" href="#">Ver Cronograma</a></li>



                                        </ul>
                                    </div>

                                </td>
                            @endif


                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(".boton-publicar").on("click", function(e) {
                e.preventDefault();
                if (confirm("¿Está seguro de que deseas publicar el evento?")) {
                    var form = $(this).parents('form:first');
                    console.log('enviando form')
                    form.submit();
                }
            });


            $(".boton-cancelar").on("click", function(e) {
                e.preventDefault();
                if (confirm("¿Está seguro de que deseas cancelar el evento?")) {
                    var form = $(this).parents('form:first');
                    console.log('enviando form')
                    form.submit();
                }
            });
        </script>
    @else
        <div class="card-body">
            <strong>No existen eventos activos</strong>
        </div>
    @endif
</div>
