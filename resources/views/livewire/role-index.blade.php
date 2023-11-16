<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="card">
        <div class="d-inline-flex p-3">
            <h1>Listado de Roles</h1>
        </div>

        <div class="car-header">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre del rol">
        </div>
        @if ($roles->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Rol</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>

                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td width="10px">
                                    <form action="{{ route('asignarRoles.delete', $role->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Eliminar</button>

                                    </form>


                                </td>
                                <td width="10px">
                                    <form action="{{route('asignarPermiso.edit',$role->id)}}">
                                        <button class="btn btn-info">Editar</button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $roles->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
