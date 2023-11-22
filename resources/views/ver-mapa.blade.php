<div id="contenedormap" class="position-absolute">
    <form action="{{ route('updateMap', ['id' => $evento->id]) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-4 mt-0">
                <p id="titleUbicacion" class="mt-2">Ubicacion del Evento</p>
                <div class="mb-4 mt-2 ml-3">
                    <input type="text" id="autocomplete" placeholder="Busca una ubicación...">
                </div>
                <div class="mb-4 mt-2  ml-3">
                    <label for="latitud" class="form-label">Latitud</label>
                    <input type="text" class="form-control" name="latitud" id="latitud"
                        value="{{ $evento->latitud }}">
                    @error('latitud')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4 ml-3">
                    <label for="longitud" class="form-label">Longitud</label>
                    <input type="text" class="form-control" name="longitud" id="longitud"
                        value="{{ $evento->longitud }}">
                    @error('latitud')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>

            </div>
            <div class="col-8 pt-5 pr-5 pl-5">
                <div id="mapa"></div>
            </div>
        </div>
        <div class="text-center mt-4">
            <button id="adiosMap" type="button" class="btn btn-secondar mr-5">Cerrar</button>
            <button type="submit" class="btn btn-primary ml-5">Guardar</button>
        </div>
    </form>
</div>