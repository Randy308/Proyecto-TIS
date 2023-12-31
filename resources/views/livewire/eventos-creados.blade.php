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
                        <th>Banner del Evento</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $evento)
                        <tr>

                            <td>{{ $evento->id }}</td>
                            <td>{{ $evento->nombre_evento }}</td>
                            <td>{{ $evento->estado }}</td>
                            <td><img src="{{ $evento->direccion_banner }}" width="170px" alt="{{ $evento->Titulo }}"></td>
                            @if (strtoupper($evento->estado) == 'BORRADOR')
                                <td >

                                    <div class="btn-group btn-group-sm" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false" style="width: 140px">
                                            Acción
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <li>
                                                <form
                                                    action="{{ route('evento.banner.edit', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                                    method="get">
                                                    <button class="dropdown-item" type="submit">Editar banner</button>

                                                </form>
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('evento.delete', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item boton-cancelar" type="button"
                                                        {{ $evento->estado != 'Borrador' ? 'disabled' : '' }}>Cancelar</button>

                                                </form>
                                            </li>
                                            <li>
                                                <form id="FormPublicar"
                                                    action="{{ route('evento.state.update', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="dropdown-item boton-publicar"
                                                        type="button">Publicar</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('evento.edit', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                                    method="get">
                                                    <button type="submit" class="dropdown-item">Editar</button>
                                                </form>
                                            </li>
                                            <li>
                                                <a href="{{ route('crear.cronograma', ['evento'=>$evento]) }}" class="dropdown-item">Cronograma</a>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                            @else
                                <td width="10px">
                                    <button class="btn btn-secondary btn-sm" disabled style="width: 140px">Publicado</button>
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
                if (confirm("¿Estás seguro de que deseas publicar el evento? Una vez publicado, no podrás realizar ediciones en el banner ni en los datos del evento. Asegúrate de revisar y confirmar que toda la información sea correcta antes de proceder.")) {
                    var form = $(this).parents('form:first');
                    console.log('enviando form');
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
            <strong>No hay registros</strong>
        </div>
    @endif
</div>
