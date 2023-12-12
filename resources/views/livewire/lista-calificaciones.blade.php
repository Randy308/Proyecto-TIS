<div class="container py-4 my-4" id="listaIntegrantesGrupos">
    <div class="d-flex justify-content-end">
        <a class="btn btn-danger" href="{{ route('misEventos', ['tab' => 1]) }}" type="submit"><i
                class="bi bi-x-lg"></i></a>
    </div>
    <p class="h4">{{ $evento->nombre_evento }}</p>
    <p class="h6">Lista de calificaciones</p>
    <div class="py-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
            Crear calificación
        </button>
        @if (strtoupper($evento->modalidad) == 'GRUPAL')
            @include('layouts.modal-crear-calificacion-grupal', [
                'evento_id' => $evento_id,
                'anterior' => $anterior,
            ])
        @else
            @include('layouts.modal-crear-calificacion', [
                'evento_id' => $evento_id,
                'anterior' => $anterior,
            ])
        @endif


    </div>
    <div class="row p-4">
        <table class="table table-bordered data-table table-responsive-sm">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nota minima</th>
                    <th>Nota maxima</th>

                    <th>Acción</th>
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
                            @if (strtoupper($evento->modalidad) == 'GRUPAL')
                                <a href="{{ route('calificar.grupos', ['evento_id' => $evento->id, 'calificacion_id' => $calificacion->id]) }}"
                                    class="btn btn-primary btn-sm" type="button">Visualizar grupos</a>
                            @else
                                <a href="{{ route('calificar.participantes', ['evento_id' => $evento->id, 'calificacion_id' => $calificacion->id]) }}"
                                    class="btn btn-primary btn-sm" type="button">Visualizar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#promedioModal">
            Finalizar calificaciones
        </button>
        @if (strtoupper($evento->modalidad) == 'GRUPAL')
        @include('layouts.modal-crear-promedio-grupos', ['evento_id' => $evento_id])

        @else
            @include('layouts.modal-crear-promedio', ['evento_id' => $evento_id])
        @endif


    </div>
</div>

