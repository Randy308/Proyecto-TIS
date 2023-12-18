<div class="mx-4">
    <div class="container bg-white pt-3 my- border rounded">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nombre_evento" class="form-label">Nombre Evento:</label>
                    <input type="text" id="nombre_evento" class="form-control" wire:model="nombre_evento" placeholder="Buscar...">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="fecha_desde" class="form-label">Fecha Desde:</label>
                    <input type="date" wire:model="fecha_desde" class="form-control" max="9999-12-31" placeholder="dd/mm/aaaa">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fecha_hasta" class="form-label">Fecha Hasta:</label>
                    <input type="date" wire:model="fecha_hasta" class="form-control" max="9999-12-31" placeholder="dd/mm/aaaa">
                </div>
            </div>
            <div class="col-md-3">
                
                <div class="form-check mt-4 pt-3">
                    <label>
                        <input class="form-check-input" type="checkbox" id="miCheckbox" wire:model="mostrarEventosComprendidos"
                            {{ $checkboxdesabled }}><span style="{{ $checkboxopacidad }}">Mostrar Eventos
                            Comprendidos</span>

                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tipo">Tipo Evento: </label>
                    <select id="tipo" wire:model="tipoSeleccionado" class="form-select form-control">
                        <option value="" selected>Todos</option>
                        @if ($tipos_eventos->isNotEmpty())
                            @foreach ($tipos_eventos as $tipo_evento)
                                <option value="{{ $tipo_evento->tipo_evento }}">{{ $tipo_evento->tipo_evento }}</option>
                            @endforeach
                        @else
                            <option value="" selected disabled>No existen tipos de evento</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select  id="estado" wire:model="estadoSeleccionado" class="form-select form-control">
                        <option value="" selected>Todos</option>
                        <option value="Borrador">Borrador</option>
                        <option value="Activo">Activo</option>
                        <option value="Finalizado">Finalizado</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="privacidad">Privacidad:</label>
                    <select id="privacidad" wire:model="privacidadSeleccionado" class="form-control">
                        <option value="" selected>Todos</option>
                        <option value="libre">Libre</option>
                        <option value="con-restriccion">Con-Restriccion</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="modalidad">Modalidad:</label>
                    <select id="modalidad" wire:model="modalidadSeleccionado" class="form-control">
                        <option value="" selected>Todos</option>
                        <option value="individual">Individual</option>
                        <option value="grupal">Grupal</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row pb-3 pl-3">
        <button class="btn btn-success" type="button">Descargar PDF</button>
    </div> --}}
    <br>
    @if (count($eventos) == 0)
    <div class="alert alert-secondary">
         No existen eventos.
      </div>
    @else
    <table class="table table-striped table-hover table-responsive-sm">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Tipo Evento</th>
                <th>Estado</th>
                <th>Privacidad</th>
                <th>Modalidad</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($eventos as $evento)
                <tr wire:click="redirectToView({{ $evento->id }})" style="cursor:pointer;">
                    <td scope="row">{{ $evento->nombre_evento }}</td>
                    <td>{{ $evento->tipo_evento }}</td>
                    <td>{{ $evento->estado }}</td>
                    <td>{{ $evento->privacidad }}</td>
                    <td>{{ $evento->modalidad }}</td>
                    <td>{{ $evento->fecha_inicio }}</td>
                    <td>{{ $evento->fecha_fin }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    @endif
</div>
