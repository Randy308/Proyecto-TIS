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
                            <td><img src="{{ $evento->direccion_banner }}" width="170px" alt="{{ $evento->Titulo }}"></td>
                            @if (strtoupper($evento->estado) == 'BORRADOR')
                                <td width="10px">
                                    <form
                                        action="{{ route('evento.banner.edit', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                        method="get">
                                        <button class="btn btn-info" type="submit">Editar <br> Banner</button>

                                    </form>


                                </td>
                                <td width="10px">
                                    <form
                                        action="{{ route('evento.delete', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"
                                            {{ $evento->estado != 'Borrador' ? 'disabled' : '' }}>Cancelar</button>

                                    </form>


                                </td>
                                <td width="10px">
                                    @if ($evento->estado == 'Activo')
                                        <button class="btn btn-secondary" disabled>Publicado</button>
                                    @else
                                        <form id="FormPublicar"
                                            action="{{ route('evento.state.update', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-warning boton-publicar"
                                                type="button">Publicar</button>
                                        </form>
                                    @endif


                                </td>
                                <td width="10px">
                                    <form
                                        action="{{ route('evento.edit', ['user' => auth()->user(), 'evento' => $evento]) }}"
                                        method="get">
                                        <button type="submit" class="btn btn-success">Editar</button>
                                    </form>

                                </td>
                            @else

                                <td width="10px">

                                </td>
                                <td width="10px">

                                </td>
                                <td width="10px">

                                </td>
                                <td width="10px">
                                    <button class="btn btn-secondary" disabled>Publicado</button>
                                </td>
                            @endif


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
        </script>
    @else
        <div class="card-body">
            <strong>No hay registros</strong>
        </div>
    @endif
</div>
