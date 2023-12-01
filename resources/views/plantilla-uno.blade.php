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

                        <h6>Tipo de evento: <b> {{ucwords( $evento->tipo_evento." ".$evento->modalidad) }}</b></h6>
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
                    <select name="tipo_evento" class="form-control @error('tipo_evento') is-invalid @enderror"
                        id="tipo_evento">
                        <option value="reclutamiento" {{ old('tipo_evento') == 'reclutamiento' ? 'selected' : '' }}>
                            Reclutamiento
                        </option>
                        <option value="competencia_individual"
                            {{ old('tipo_evento') == 'competencia_individual' ? 'selected' : '' }}>
                            Competencia Individual</option>
                        <option value="competencia_grupal"
                            {{ old('tipo_evento') == 'competencia_grupal' ? 'selected' : '' }}>
                            Competencia Grupal(4)</option>
                        <option value="taller_individual"
                            {{ old('tipo_evento') == 'taller_individual' ? 'selected' : '' }}>
                            Taller
                            Individual</option>
                        <option value="taller_grupal" {{ old('tipo_evento') == 'taller_grupal' ? 'selected' : '' }}>
                            Taller
                            Grupal(4)
                        </option>
                    </select>

                </div>
            </div>
        </div>



    </div>
    @if ($evento->auspiciadors->count())
        <div class="row pt-4">
            <div class="card">
                <h5>Auspiciadores</h5>
                <div class="container p-3 ">
                    <div class="row">
                        <div class="col border p-0 ml-3">

                            <div id="contenedorDeImagenAuspiciadores">


                                @foreach ($evento->auspiciadors as $item)
                                    <img src="{{ asset($item->url) }}" alt="logo-banner-{{ $item->nombre }}" />
                                @endforeach

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
