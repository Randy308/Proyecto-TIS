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
                                                    <a href="#" class="dropdown-item" id="modalNotificarButton{{$evento->id}}">Notificar Usuarios</a>
                                                </li>
                                            @endif


                                        </ul>
                                    </div>


                                </td>
                            @endif


                            </td>

                            
                        </tr>
                        @livewire('notificaciones-form',['evento'=>$evento])
                        
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
