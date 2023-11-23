<div class="container">
    <div class="row">

        <div class="col-md-12 mb-3">
            <label for="">Búsqueda por Nombre</label>


            <div class="input-group mb-3">
                <input wire:model="search" type="text" class="form-control" placeholder="Buscar...">
                <div class="input-group-append">

                    <button type="button" id="BottonFiltrado" class="btn btn-info"><i
                            class="bi bi-funnel-fill"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div id="filtrosEvento"  class="FiltroInvisible" >
        <div class="row">
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
                        <option value="{{ $rol->name }}">{{ $rol->name }}</option>
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
    </div>
    @if ($usuarios->count())
        <div class="card-body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $user)
                        <tr>

                            <td width="10px">{{ $user->id }}</td>
                            <td width: auto;>{{ $user->name }}</td>
                            <td width: auto;>{{ $user->email }}</td>


                            @if ($user->roles->count())
                                <td width: auto;>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                            @else
                                <td>No esta validado</td>
                            @endif
                            <td width="10px">

                                <div class="btn-group" role="group">

                                    <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        style="width: 150px">
                                        Acción
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a href="{{ route('verUsuario', $user->id) }}" class="dropdown-item"
                                            type="button">Ver Detalles</a>
                                        <a class="dropdown-item" href="{{ route('asignarRoles.edit', $user->id) }}"
                                            type="submit">Editar Roles</a>
                                        <form id="FormularioEli" action="{{ route('user.delete', $user->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button id="BotonEliminar" class="dropdown-item" type="submit">Eliminar
                                                Usuario</button>

                                        </form>
                                    </div>
                                </div>

                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $usuarios->links() }}
        </div>
        <script>
            $("#BotonEliminar").on("click", function(e) {
                e.preventDefault();
                if (confirm("¿Está seguro de eliminar a este usuario?")) {
                    var form = $("#BotonEliminar").parents('form:first');
                    form.submit();
                }
            });
        </script>
    @else
        <div class="card-body">
            <strong>No hay registros</strong>
        </div>
    @endif
</div>
@livewireScripts
