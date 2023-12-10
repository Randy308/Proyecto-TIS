<div id="FormCrearEvento">
    <div class="row pt-4 pb-4">
        <div class="card">
            {{-- contenedor modal y banner  --}}
            <div id="contenedor_bannerM" class="contenedor-banner position-relative">
                {{-- <div id="fondotransparente"></div> --}}
                <img src="{{ asset($evento->direccion_banner) }}" alt="logo-banner" id="miBanner" />
            </div>
            {{--  --}}
            <div class="div-titulos p-4">
                <div class="row">
                    <div class="col">
                        <h5>Fecha: <b>{{ $mifechaFinal }}</b></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h1 id="miTitulo">{{ $evento->nombre_evento }}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                        <h6>Tipo de evento: <b> {{ ucwords($evento->tipo_evento . ' ' . $evento->modalidad) }}</b></h6>
                    </div>
                    @include('layouts.botont-registrarse-evento')
                </div>

            </div>
        </div>
    </div>
    <div class="row  card pt-4 pb-4">

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">Información</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                    type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">Cronograma</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                    type="button" role="tab" aria-controls="pills-contact"
                    aria-selected="false">Resultados</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @include('layouts.informacion-evento', ['evento' => $evento])</div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div id="tab2">
                    @php
                        $editable = false;
                        $fases = $evento->fasesEventos->sortBy('secuencia');
                    @endphp
                    @include('layouts.cronograma-evento', [
                        'fases' => $fases,
                        'editable' => $editable,
                    ])

                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div id="tab3">


                    @if ($calificaciones_final)

                        @if (strtoupper($evento->modalidad) == 'GRUPAL')

                            <div class="d-flex py-4 my-4  justify-content-center container_podium podium">
                                @php
                                    $contador = 1;
                                    $primeros_tres = [];
                                    $otros = [];
                                @endphp

                                @foreach ($calificaciones_final as $item)
                                    @if ($contador <= 3)
                                        <!-- Almacenar los primeros 3 en un array -->
                                        @php
                                            $primeros_tres[] = $item;
                                        @endphp
                                    @else
                                        <!-- Almacenar los demás en otro array -->
                                        @php
                                            $otros[] = $item;
                                        @endphp
                                    @endif

                                    @php
                                        $contador++;
                                    @endphp
                                @endforeach

                                <!-- Mostrar los primeros 3 en el podio -->
                                @foreach ($primeros_tres as $item)
                                    <div class="podium__item">
                                        <p class="podium__city">{{ $item->nombre_grupo }}</p>
                                        <div class="podium__rank podium{{ $loop->index + 1 }}">{{ $loop->index + 1 }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Mostrar los demás en una lista -->
                            @if(count($otros))
                                <div class="d-flex justify-content-center p-4 list">
                                    <table class="table table-bordered data-table table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre del Grupo</th>
                                                <th>Puntaje</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($otros as $data)
                                                <tr>
                                                    <td>
                                                        {{ $loop->index + 4 }}
                                                    </td>
                                                    <td>
                                                        {{ $data->nombre_grupo }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $data->puntaje }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @else
                            <div class="d-flex py-4 my-4 justify-content-center container_podium podium">
                                @php
                                    $contador = 1;
                                    $primeros_tres = [];
                                    $otros = [];
                                @endphp

                                @foreach ($calificaciones_final as $item)
                                    @if ($contador <= 3)
                                        <!-- Almacenar los primeros 3 en un array -->
                                        @php
                                            $primeros_tres[] = $item;
                                        @endphp
                                    @else
                                        <!-- Almacenar los demás en otro array -->
                                        @php
                                            $otros[] = $item;
                                        @endphp
                                    @endif

                                    @php
                                        $contador++;
                                    @endphp
                                @endforeach

                                <!-- Mostrar los primeros 3 en el podio -->
                                @foreach ($primeros_tres as $item)
                                    <div class="podium__item">
                                        <p class="podium__city">{{ $item->name }}</p>
                                        <div class="podium__rank podium{{ $loop->index + 1 }}">{{ $loop->index + 1 }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Mostrar los demás en una lista -->
                            @if (count($otros))
                                <div class="d-flex justify-content-center p-4 list">
                                    <table class="table table-bordered data-table table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Integrante</th>
                                                <th>Puntaje</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($calificaciones_final as $data)
                                                <tr>
                                                    <td>
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td>
                                                        {{ $data->name }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $data->puntaje }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif


                        @endif


                    @endif
                </div>
            </div>



        </div>

    </div>
