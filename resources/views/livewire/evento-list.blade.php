


<div class="container">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="">Búsqueda por Nombre</label>
                <div class="input-group">
                    <input wire:model="search" type="text" class="form-control" placeholder="Buscar...">
                </div>
            </div>
    
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
                    <option value="">Todos</option>
                    <option value="borrador">Borrador</option>
                    <option value="activo">Activo</option>
                    <option value="finalizado">Finalizado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
    
            <div class="col-md-3 mb-3">
                <label for="">Filtrar por Categoría:</label>
                <select wire:model="filtroCategoria" class="form-control">
                    <option value="">Todos</option>
                    <option value="Diseño">Diseño</option>
                    <option value="QA">QA</option>
                    <option value="Desarrollo">Desarrollo</option>
                    <option value="Ciencia de datos">Ciencia de datos</option>
                </select>
            </div>

            @php
                $mes = date('n');
                $anio = date('Y');

                $gesActual = "";
                if($mes <= 6){
                    $gesActual = "I";
                }else{
                    $gesActual = "II";
                }
            @endphp

            <div class="col-md-3 mb-3">
                <label for="">Filtrar por Gestion:</label>
                <select wire:model="filtroGestion" class="form-control">
                    
                    <option value="{{ json_encode(['anio' => $anio , 'gestion' => $gesActual]) }}">{{$anio}} - {{$gesActual}}</option>
                    
                    <option value="">Todo</option>

                    @foreach ($gestiones as $gestion)

                        @if($anio != $gestion->anio || $gesActual != $gestion->gestion)
                        <option value="{{ json_encode(['anio' => $gestion->anio , 'gestion' => $gestion->gestion]) }}">{{$gestion->anio}} - {{$gestion->gestion}}</option>
                        @endif

                        
                    @endforeach

                </select>
                

            </div>

        </div>
    
    <div class="row">
        @if($eventos->count() == 0)
        <div class="col-12">
            <div class="alert alert-info">
                No hay eventos disponibles.
            </div>
        </div>
        @endif


        @foreach ($eventos as $evento)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-relative">
                        <div class="cintaCategoria">{{ $evento->categoria }}</div>
                        <a href="{{ route('verEvento', $evento->id) }}">
                            <img src="{{ $evento->direccion_banner }}" class="card-img-top" alt="{{ $evento->Titulo }}">
                        </a>
                        <div class="{{$evento->estado}}">{{ $evento->estado }}</div>




                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->nombre_evento }}</h5>
                        <p class="card-text">{{ $evento->descripcion_evento }}</p>
                        <p class="card-text" >{{ $evento->fecha_inicio->format('Y-m-d H:i:s') }}</p>
                        <p class="card-text" >{{ $evento->fecha_fin->format('Y-m-d H:i:s') }}</p>
                        
                    </div>
                </div>
            </div>
        @endforeach

        
    </div>
    
    {{ $eventos->links() }} 
</div>
@livewireScripts


