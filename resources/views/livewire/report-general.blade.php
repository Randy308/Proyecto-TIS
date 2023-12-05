<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="fecha_desde">Fecha de Desde <span
                        class="text-danger font-weight-bold ">*</span></label>
                <input type="date" name="fecha_desde"
                    class="form-control @error('fecha_desde') is-invalid @enderror"
                    id="fecha_desde" value="{{ old('fecha_desde') }}" required
                    aria-describedby="fecha_desde_help">
                @error('fecha_desde')
                    <span id="fecha_desde_help" class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="fecha_hasta">Fecha de Hasta <span
                        class="text-danger font-weight-bold ">*</span></label>
                <input type="date" name="fecha_hasta"
                    class="form-control @error('fecha_hasta') is-invalid @enderror"
                    id="fecha_hasta" value="{{ old('fecha_hasta') }}" required
                    aria-describedby="fecha_hasta_help">
                @error('fecha_hasta')
                    <span id="fecha_hasta_help" class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row pb-3 pl-3">
        <button class="btn btn-success" type="button">Descargar PDF</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventos as $evento )
            <tr>
                <td scope="row">{{$evento->nombre_evento}}</td>
                <td>{{$evento->fecha_inicio}}</td>
                <td>{{$evento->fecha_fin}}</td>
            </tr>    
            @endforeach
            
        </tbody>
    </table>
</div>
