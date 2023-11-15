<div>

    @if ($eventos->count())
        <h3 class="p-3">Lista de Eventos Creados</h3>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Evento</th>
                        <th>Estado del Evento</th>
                        <th>Banner del Evento</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $evento)
                        <tr>

                            <td>{{ $evento->id }}</td>
                            <td>{{ $evento->nombre_evento }}</td>
                            <td>{{ $evento->estado }}</td>
                            <td><img src="{{asset($evento->direccion_banner)  }}" width="170px" alt="{{ $evento->Titulo }}"></td>
                            <td width="10px">
                                <form
                                    action="{{ route('evento.banner.edit', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                    method="get">
                                    <button class="btn btn-info" type="submit">Editar Banner</button>

                                </form>


                            </td>
                            <td width="10px">
                                <form
                                    action="{{ route('evento.delete', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" {{$evento->estado != 'Borrador' ? 'disabled' : ''}}>Cancelar</button>

                                </form>


                            </td>
                            <td width="10px">
                                @if ($evento->estado == 'Activo')
                                <button class="btn btn-secondary" disabled>Ya se ha Publicado</button>
                                @else
                                    <form id="FormPublicar"
                                        action="{{ route('evento.state.update', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                        method="post">
                                        @csrf
                                        @method('PUT')

                                    </form>
                                    <button id="BotonPublicarEvento" class="btn btn-warning"
                                        type="button">Publicar</button>
                                @endif


                            </td>
                            <td width="10px">
                                <form
                                    action="{{ route('evento.edit', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                    method="get">
                                    <button type="submit" class="btn btn-success">Editar</button>
                                </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="card-body">
            <strong>No hay registros</strong>
        </div>
    @endif
</div>
