


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
                <div class="position-relative">
                    <div class="cintaRol">{{$usuario->getRoleNames()->first()}}</div>
                    <a href="{{ route('verUsuario', $usuario->id) }}">
                        <img src="{{$usuario->foto_perfil}}" class="card-img-top" alt="imagen no encontrada">
                    </a>
                    <div class="{{$usuario->estado}}">{{$usuario->estado}}</div>




                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $usuario->name }}</h5>
                    <p class="card-text">{{ $usuario->email }}</p>
                    <p class="card-text">{{ $usuario->instituto }}</p>
                </div>
            </div>
        </div>
    @endforeach
 
    
</div>

{{ $usuarios->links() }} 
</div>
@livewireScripts