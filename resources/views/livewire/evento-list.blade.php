<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="">Búsqueda por Nombre</label>
            <div class="input-group mb-3">
                <input wire:model="search" type="text" class="form-control" placeholder="Buscar...">
                <div class="input-group-append">

                    <button type="button" id="BottonFiltrado" class="btn btn-info"><i
                            class="bi bi-funnel-fill"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div id="filtrosEvento" class="FiltroInvisible">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="">Ordenar por:</label>
                <select wire:model="orderb" class="form-control">
                    <option value="0">Recientes</option>
                    <option value="1">Antiguos</option>
                    <option value="2">Nombre A-Z</option>
                    <option value="3">Nombre Z-A</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label for="">Filtrar por Estado:</label>
                <select wire:model="filtroEstado" class="form-control">
                    <option value="activo">Activo</option>
                    <option value="borrador">Borrador</option>
                    <option value="finalizado">Finalizado</option>
                    <option value="cancelado">Cancelado</option>
                    <option value="">Todos</option>
                </select>
            </div>

            {{-- <div class="col-md-3 mb-3">
                <label for="">Filtrar por Categoría:</label>
                <select wire:model="filtroCategoria" class="form-control">
                    <option value="">Todos</option>
                    <option value="Diseño">Diseño</option>
                    <option value="QA">QA</option>
                    <option value="Desarrollo">Desarrollo</option>
                    <option value="Ciencia de datos">Ciencia de datos</option>
                </select>
            </div> --}}

            @php
                $mes = date('n');
                $anio = date('Y');

                $gesActual = '';
                if ($mes <= 6) {
                    $gesActual = 'I';
                } else {
                    $gesActual = 'II';
                }
            @endphp

            <div class="col-md-3 mb-3">
                <label for="">Filtrar por Gestion:</label>
                <select wire:model="filtroGestion" class="form-control">

                    <option value="{{ json_encode(['anio' => $anio, 'gestion' => $gesActual]) }}">{{ $anio }} -
                        {{ $gesActual }}</option>

                    <option value="">Todo</option>

                    @foreach ($gestiones as $gestion)
                        @if ($anio != $gestion->anio || $gesActual != $gestion->gestion)
                            <option
                                value="{{ json_encode(['anio' => $gestion->anio, 'gestion' => $gestion->gestion]) }}">
                                {{ $gestion->anio }} - {{ $gestion->gestion }}</option>
                        @endif
                    @endforeach

                </select>


            </div>
        </div>
    </div>

    <div class="row">
        @if ($eventos->count() == 0)
            <div class="col-12">
                <div class="alert alert-info">
                    No hay eventos disponibles.
                </div>
            </div>
        @endif


        @foreach ($eventos as $evento)
            <div class="col-md-4 mb-3">
                <a href="{{ route('verEvento', $evento->id) }}">
                    <div class="contenedor card position-relative {{ $evento->estado }}">
                        <div class="card-header">
                            <div class="cintaCategoria">{{ $evento->tipo_eventoo }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row d-flex">
                                <div class="col-4">
                                    @if (strtoupper($evento->estado) == 'CANCELADO')
                                        <i class="bi bi-calendar-x display-4"></i>
                                    @elseif(strtoupper($evento->estado) == 'FINALIZADO')
                                        <i class="bi bi-calendar2-check display-4"></i>
                                    @elseif(strtoupper($evento->estado) == 'ACTIVO')
                                        <i class="bi bi-calendar-event display-4"></i>
                                    @else
                                        <i class="bi bi-calendar2-plus display-4"></i>
                                    @endif

                                </div>
                                <div class="col-6">

                                    <p class="h6">{{ $evento->nombre_evento }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    @if (!empty($evento->descripcion_evento))
                                        <p class="card-text"><b class=" font-weight-bold">Descripción:
                                            </b>{{ $evento->descripcion_evento }}</p>
                                    @endif
                                    <p class="card-text"><b class=" font-weight-bold">Tipo de evento:
                                    </b>{{ucwords( $evento->tipo_evento." ".$evento->modalidad) }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text"><span>Desde: </span>
                                        {{ \Carbon\Carbon::parse($evento->fecha_inicio)->formatLocalized('%d %b %Y') }}
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><span>Hasta: </span>
                                        {{ \Carbon\Carbon::parse($evento->fecha_fin)->formatLocalized('%d %b %Y') }}
                                    </p>
                                </div>


                            </div>

                            <div class="pt-4">{{ $evento->estado }}</div>



                        </div>
                    </div>

                </a>

            </div>
        @endforeach


    </div>

    {{ $eventos->links() }}
</div>
@livewireScripts
