<div class="container py-4 my-4" id="listaIntegrantesGrupos">
    <div class="d-flex justify-content-end">
        <button class="btn btn-danger" type="submit" onclick="history.back()"><i class="bi bi-x-lg"></i></button>
    </div>
    <p class="h4">{{ $grupo->nombre }}</p>
    <p class="h6">Lista de integrantes</p>
    <div class="row p-4">
        <table class="table table-bordered data-table table-responsive-sm">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>

                    @if ($evento->privacidad == 'con-restriccion')
                        <th>Codigo sis</th>
                    @endif
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($integrantes as $integrante)
                    <tr>
                        <td>
                            {{ $integrante->name }}
                        </td>
                        <td>
                            {{ $integrante->email }}</a>
                        </td>
                        <td>
                            {{ $integrante->telefono }}</a>
                        </td>

                        @if ($evento->privacidad == 'con-restriccion')
                            <td>
                                {{ $integrante->cod_estudiante }}</a>
                            </td>
                        @endif

                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <button id="btnGroupDropdown" type="button" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="width: 140px">
                                    Acción
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDropdown">
                                    <li>

                                        <a href="{{ route('ver.participante', $integrante->id) }}" class="dropdown-item"
                                            type="button">Ver Perfil</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
