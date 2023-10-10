


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
                    <option value="Categoria 1">Categoria 1</option>
                    <option value="Categoria 2">Categoria 2</option>
                    <option value="Categoria 3">Categoria 3</option>
                </select>
            </div>
        </div>
    
    <div class="row">
        


        @foreach ($eventos as $evento)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-relative">
                        <div class="cintaCategoria">{{ $evento->categoria }}</div>
                        <img src="{{ $evento->direccion_banner }}" class="card-img-top" alt="{{ $evento->Titulo }}">
                        <div class="cintaEstado">{{ $evento->estado }}</div>
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
    
    
    {{ $eventos->links('livewire.custom-pagination-link') }} 
</div>
@livewireScripts