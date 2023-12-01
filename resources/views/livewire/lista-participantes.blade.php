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
                                    @if ($data->estado != 'Habilitado')
                                        <li>
                                            <form method="POST"
                                                action="{{ route('habilitar.participacion', ['evento_id' => $evento->id, 'asistencia_id' => $data->asistencia_id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button class="dropdown-item habilitar.participacion"
                                                    type="submit">Habilitar
                                                    participacion</button>
                                            </form>

                                        </li>
                                    @endif

                                    <li>
                                        <form method="POST"
                                            action="{{ route('rechazar.participacion', ['evento_id' => $evento->id, 'asistencia_id' => $data->asistencia_id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <button class="dropdown-item rechazar.participacion" type="submit">Rechazar
                                                participacion</button>
                                        </form>

                                    </li>
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
</div>
