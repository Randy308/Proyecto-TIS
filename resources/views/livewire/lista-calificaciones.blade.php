<div class="container py-4 my-4" id="listaIntegrantesGrupos">
    <div class="d-flex justify-content-end">
        <button class="btn btn-danger" type="submit" onclick="history.back()"><i class="bi bi-x-lg"></i></button>
    </div>
    <p class="h4">{{ $evento->nombre_evento }}</p>
    <p class="h6">Lista de calificaciones</p>
    <div class="py-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
            Crear calificación
        </button>
        @include('layouts.modal-crear-calificacion',['evento_id'=> $evento_id ])
    </div>
    <div class="row p-4">
        <table class="table table-bordered data-table table-responsive-sm">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nota minima</th>
                    <th>Nota maxima</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($calificaciones as $calificacion)
                    <tr>
                        <td>
                            {{ $calificacion->nombre }}
                        </td>
                        <td>
                            {{ $calificacion->nota_minima_aprobacion }}</a>
                        </td>
                        <td>
                            {{ $calificacion->nota_maxima }}</a>
                        </td>



                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <button id="btnGroupDropdown" type="button" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="width: 140px">
                                    Acción
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDropdown">
                                    <li>

                                        <a href="{{ route('calificar.participantes', ['evento_id' => $evento->id, 'calificacion_id' => $calificacion->id]) }}" class="dropdown-item"
                                            type="button">Calificar</a>
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
