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
                            <a href="" class="update" data-name="estado" data-type="select" class="btn btn-link"
                                data-pk="{{ $data->user_id }}" data-title="Seleccione el estado"
                                data-source='{"habilitado": "Habilitado", "deshabilitado": "Deshabilitado"}'>
                                {{ $data->estado }}
                            </a>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <button id="btnGroupDrop_{{ $data->asistencia_id }}" type="button" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="width: 140px">
                                    Acción
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop_{{ $data->asistencia_id }}">
                                    <li>
                                        <button class="dropdown-item enable-participation" data-asistencia_id="{{ $data->asistencia_id }}" type="button">Habilitar participacion</button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item reject-participation" data-asistencia_id="{{ $data->asistencia_id}}" type="button">Rechazar participacion</button>
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
