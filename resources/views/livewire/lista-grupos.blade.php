<div class="container py-4 my-4" id="listaIntegrantesGrupos">
    <div class="d-flex justify-content-end">
        <a class="btn btn-danger" href="{{ route('misEventos', ['tab' => 1]) }}" type="submit"><i
                class="bi bi-x-lg"></i></a>
    </div>
    <p>{{ $evento->calificacions->count() }}</p>
    <p class="h3">Lista de grupos</p>

    @if ($grupos->count())
        <div class="d-flex justify-content-end">
            <form action="{{ route('aceptar.all.grupos', ['evento_id' => $evento->id]) }}" method="POST">

                @csrf
                @method('PUT')
                <button class="btn btn-sm btn-success boton-habilitar-todos" type="button">Aceptar a todos los grupos</button>
            </form>

        </div>
        <div class="row p-4">
            <table class="table table-bordered data-table table-responsive-sm">
                <thead>
                    <tr>
                        <th>Nombre del Grupo</th>
                        <th>Coach</th>
                        <th>Cantidad de participantes</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grupos as $grupo)
                        <tr>
                            <td>
                                {{ $grupo->nombre }}
                            </td>
                            <td>
                                {{ $grupo->user->email }}</a>
                            </td>
                            <td>
                                {{ $grupo->users_pertenecen_grupos->count() }}</a>
                            </td>

                            <td>
                                {{ $grupo->estado }}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button id="btnGroupDropdown" type="button" class="btn btn-primary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="width: 140px">
                                        Acción
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDropdown">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('ver.grupo.integrantes', ['evento_id' => $evento->id, 'grupo_id' => $grupo->id]) }}">Ver
                                                integrantes</a>
                                        </li>
                                        @if ($grupo->estado != 'Habilitado')
                                            <li>
                                                <form method="POST"
                                                    action="{{ route('habilitar.grupo.participacion', ['evento_id' => $evento->id, 'grupo_id' => $grupo->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="dropdown-item habilitar_participacion"
                                                        type="button">Habilitar
                                                        participación</button>
                                                </form>

                                            </li>

                                            <li>
                                                <form method="POST"
                                                    action="{{ route('rechazar.grupo.participacion', ['evento_id' => $evento->id, 'grupo_id' => $grupo->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="dropdown-item rechazar_participacion"
                                                        type="button">Rechazar
                                                        participación</button>
                                                </form>

                                            </li>
                                        @endif

                                        @if ($grupo->estado != 'Pendiente')
                                            <li>
                                                <form method="POST"
                                                    action="{{ route('posponer.grupo.participacion', ['evento_id' => $evento->id, 'grupo_id' => $grupo->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="dropdown-item posponer.posponer"
                                                        type="submit">Posponer
                                                        participación</button>
                                                </form>

                                            </li>
                                        @endif


                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            {{ $grupos->links() }}
        </div>
        <script>
            $(".rechazar_participacion").on("click", function(e) {
                e.preventDefault();
                if (confirm("¿Está seguro de eliminar la participacion este usuario?")) {
                    var form = $(this).parents('form:first');
                    form.submit();
                }
            });
        </script>
        <script>
            $(".habilitar_participacion").on("click", function(e) {
                e.preventDefault();
                if (confirm("¿Está seguro de aceptar la participacion este usuario?")) {
                    var form = $(this).parents('form:first');
                    form.submit();
                }
            });
            $(".boton-habilitar-todos").on("click", function(e) {
                e.preventDefault();
                if (confirm("¿Está seguro de que deseas habilitar a todos los participantes en el evento?")) {
                    var form = $(this).parents('form:first');
                    console.log('enviando form')
                    form.submit();
                }
            });
        </script>
    @else
        <div class="card-body">
            <strong>No hay registros de grupos</strong>
        </div>
    @endif

</div>
