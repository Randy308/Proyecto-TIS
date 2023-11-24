

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre de la Fase</th>
                                <th>Descripción</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fases as $fase)
                            <tr>
                                <td>{{ $fase->nombre_fase }}</td>
                                <td>{{ $fase->descripcion_fase }}</td>
                                <td>{{ $fase->fechaInicio->format('H:i d/m/Y') }}</td>
                                <td>{{ $fase->fechaFin->format('H:i d/m/Y') }}</td>
                                <td>{{ $fase->tipo }}</td>
                                
                                <td>
                                    <button class="btn btn-primary btn-sm btnEditar" data-toggle="modal" data-target="#fasesModalEdit" data-fase="{{ $fase }}">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    @if( $fase->tipo !== 'Inscripcion' && $fase->tipo !== 'Finalizacion')
                                        <button  class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                       
                                    @endif
                                    
                                </td>

                            </tr>
                           
                            @endforeach
                        </tbody>
                    </table>
                </table>
            </div>
        </div>
    </div>
</div>

@php

    $faseActual = $fases[0];
@endphp

<script>
    $(document).ready(function() {
        $('.btnEditar').click(function() {
            // Obtener el ID de la fase desde el botón
            $faseActual     = $(this).data('fase');

            // Aquí puedes usar AJAX para obtener los detalles de la fase según el ID y llenar el contenido del modal
            // Por ejemplo, podrías hacer una petición AJAX a tu servidor con el ID de la fase y actualizar el contenido del modal

            // Luego, abre el modal
            $('#fasesModalEdit').modal('show');
        });
    });
</script>


@include('fasesFormEdit')
<script src="{{ asset('js/login-form.js') }}"></script>
