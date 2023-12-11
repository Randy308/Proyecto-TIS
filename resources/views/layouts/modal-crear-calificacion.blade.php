<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear calificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('calificaciones.create', ['evento_id' => $evento_id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="formName">Nombre de la calificacion<span
                                class="text-danger font-weight-bold ">*</span></label>
                        <input type="text" id="formName" class="form-control" name="nombre"
                            class="@error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" />
                        @error('nombre')
                            <div class="alert alert-danger"><small>{{ $message }}</small></div>
                        @enderror

                        <div class="alert alert-danger" role="alert" id="nameCheck">

                        </div>
                    </div>
                    @if ($anterior)
                        <div class="form-outline mb-4">
                            <label class="form-label" for="formMinimo">Nota minima de aprobación<span
                                    class="text-danger font-weight-bold ">*</span></label>
                            <input type="number" min="1" id="formMinimo" class="form-control"
                                name="nota_minima_aprobacion"
                                class="@error('nota_minima_aprobacion') is-invalid @enderror"
                                value="{{ $anterior->nota_minima_aprobacion }}" readonly/>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="formMaximo">Nota maxima<span
                                    class="text-danger font-weight-bold ">*</span></label>
                            <input type="number" id="formMaximo" class="form-control" name="nota_maxima"
                                value="{{ $anterior->nota_maxima }}"  readonly/>
                        </div>
                    @else
                        <div class="form-outline mb-4">
                            <label class="form-label" for="formMinimo">Nota minima de aprobación<span
                                    class="text-danger font-weight-bold ">*</span></label>
                            <input type="number" min="1" id="formMinimo" class="form-control"
                                name="nota_minima_aprobacion" value="{{ old('nota_minima_aprobacion') }}" />
                            @error('nota_minima_aprobacion')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror

                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="formMaximo">Nota maxima<span
                                    class="text-danger font-weight-bold ">*</span></label>
                            <input type="number" id="formMaximo" class="form-control" name="nota_maxima"
                                class="@error('nota_maxima') is-invalid @enderror" value="{{ old('nota_maxima') }}" />
                            @error('nota_maxima')
                                <div class="alert alert-danger"><small>{{ $message }}</small></div>
                            @enderror

                        </div>
                        <div>
                            <p class="fs-6">Si crea una calificacion , se deshabilitara la opcion para aceptar la solicitud de mas participantes al evento</p>
                        </div>
                    @endif

                    {{-- <div class="form-outline mb-4">
                        <div class="form-check">
                            <input class="form-check-input" name="checkbox" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Sera la ultima calificación ?
                            </label>
                          </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear nueva calificacion</button>
                </div>
            </form>
        </div>
    </div>
</div>
