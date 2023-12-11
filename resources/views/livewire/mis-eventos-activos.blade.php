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
                                                <li><a class="dropdown-item"
                                                        href="{{ route('ver.grupos', ['evento_id' => $evento->id]) }}">Ver
                                                        Grupos</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('calificaciones.grupo.index', ['evento_id' => $evento->id]) }}">Calificar
                                                        Grupos</a></li>
                                            @else
                                                <li><a class="dropdown-item"
                                                        href="{{ route('ver.participantes', ['evento_id' => $evento->id]) }}">Ver
                                                        Participantes</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('calificaciones.index', ['evento_id' => $evento->id]) }}">Calificaciones</a>
                                                </li>
                                            @endif
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ver.cronograma', ['evento' => $evento->id]) }}">Ver
                                                    Cronograma</a></li>
                                            <li>

                                                <form action="{{ route('finalizar.evento', ['id' => $evento->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="dropdown-item boton-finalizar" type="button">Finalizar
                                                        Evento</button>
                                                </form>

                                            </li>

                                            @if (strtoupper($evento->estado) == 'ACTIVO')
                                                <li>
                                                    <a href="#" class="dropdown-item"
                                                        id="modalNotificarButton{{ $evento->id }}">Notificar
                                                        Participantes</a>
                                                </li>
                                            @endif


                                        </ul>
                                    </div>


                                </td>
                            @endif


                            </td>


                        </tr>
                        <form action="{{ route('notificarParticipantes', $evento->id) }}" method="POST">
                            @csrf

                            <div class="modal fade" id="notificarModal{{ $evento->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                <center>Notificar a los Participantes</center>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nombre_fase">Asunto:</label>
                                                <input type="text" class="form-control" id="asunto" name="asunto"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="descripcion_fase">Detalle:</label>
                                                <textarea class="form-control" id="detalle" name="detalle" rows="4" required></textarea>
                                            </div>


                                            <div class="d-flex flex-column">
                                                <button type="submit" id="botonNotificaciones"
                                                    class="btn btn-primary">Crear</button>

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </form>
                        <script>
                            document.getElementById('modalNotificarButton{{ $evento->id }}').addEventListener('click', function(event) {
                                event.preventDefault();

                                // Abre el modal
                                $('#notificarModal{{ $evento->id }}').modal('show');
                            });
                        </script>
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

            $(".boton-finalizar").on("click", function(e) {
                e.preventDefault();
                if (confirm("¿Está seguro de que deseas finalizar el evento?")) {
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
