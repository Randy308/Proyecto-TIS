<div class="container py-4">
    <p class="h3">Lista de participantes</p>
    <div class="row">
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>

                    @if ($evento->privacidad == 'con-restriccion')
                        <th>Codigo sis</th>
                    @endif
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($combinedData as $data)
                    <tr>
                        <td>
                            {{ $data->name }}
                        </td>
                        <td>
                            {{ $data->email }}</a>
                        </td>
                        <td>
                            {{ $data->telefono }}</a>
                        </td>

                        @if ($evento->privacidad == 'con-restriccion')
                            <td>
                                {{ $data->cod_estudiante }}</a>
                            </td>
                        @endif

                        <td>
                            {{ $data->estado }}
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <button id="btnGroupDropdown" type="button" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="width: 140px">
                                    Acción
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDropdown">
                                    <li>
                                        <button class="dropdown-item rechazar.participacion" type="submit">Ver
                                            perfil</button>
                                    </li>
                                    @if ($data->estado != 'Habilitado')
                                        <li>
                                            <form method="POST"
                                                action="{{ route('habilitar.participacion', ['evento_id' => $evento->id, 'asistencia_id' => $data->asistencia_id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button class="dropdown-item habilitar_participacion"
                                                    type="button">Habilitar
                                                    participación</button>
                                            </form>

                                        </li>

                                        <li>
                                            <form method="POST"
                                                action="{{ route('rechazar.participacion', ['evento_id' => $evento->id, 'asistencia_id' => $data->asistencia_id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button class="dropdown-item rechazar_participacion"
                                                    type="button">Rechazar
                                                    participación</button>
                                            </form>

                                        </li>
                                    @endif

                                    @if ($data->estado != 'Pendiente')
                                        <li>
                                            <form method="POST"
                                                action="{{ route('posponer.participacion', ['evento_id' => $evento->id, 'asistencia_id' => $data->asistencia_id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button class="dropdown-item posponer.posponer" type="submit">Posponer
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
        {{ $combinedData->links() }}
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
    </script>
</div>
