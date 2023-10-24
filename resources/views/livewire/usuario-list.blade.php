


<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="">Búsqueda por Nombre</label>
            <div class="input-group">
                <input wire:model="search" type="text" class="form-control" placeholder="Buscar...">
            </div>
        </div>

        
    </div>

<div class="row">
    


    @foreach ($usuarios as $usuario)
        <div class="col-md-4 mb-3">
            <div class="card">
              
                <div class="card-body">
                    <h5 class="card-title">{{ $usuario->name }}</h5>
                    <p class="card-text">{{ $usuario->email }}</p>
                    
                </div>
            </div>
        </div>
    @endforeach

    
</div>

{{ $usuarios->links() }} 
</div>
@livewireScripts