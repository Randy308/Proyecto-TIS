


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
            <label for="">Filtrar por Rol:</label>
            <select wire:model="filtroRol" class="form-control">
                <option value="">Todos</option>
                @foreach ($roles as $rol)
                <option value="{{$rol->name}}">{{$rol->name}}</option>
                @endforeach
            </select>
        </div>



        <div class="col-md-3 mb-3">
            <label for="">Filtrar por Estado:</label>
            <select wire:model="filtroEstado" class="form-control">
                <option value="">Todos</option>
                <option value="Habilitado">Habilitado</option>
                <option value="Deshabilitado">Deshabilitado</option>
            </select>
        </div>





    </div>

<div class="row">
    @if($usuarios->count() == 0)
        <div class="col-12">
            <div class="alert alert-info">
                No se encontro Usuarios.
            </div>
        </div>
        @endif


    @foreach ($usuarios as $usuario)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-relative">
                    <div class="cintaRol">{{$usuario->getRoleNames()->first()}}</div>
                    <a href="{{ route('verUsuario', $usuario->id) }}">
                       <div class="d-flex justify-content-center">
                        <img src="{{$this->getProfileImage($usuario)}}"  class="card-img-top" alt="imagen no encontrada" style="width:200px; height:200px" >
                       </div>
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
