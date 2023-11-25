<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="card">
        <div class="d-flex justify-content-between p-3 flex-wrap">
            <div class="d-flex justify-content-start">
                <p class="h4">Listado de Roles</p>
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Crear nuevo rol
                </button>
            </div>



        </div>

        <div class="card-header">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre del rol">
        </div>
        @if ($roles->count())
            <div class="card-body">
                <table class="table table-striped table-responsive-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Rol</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>

                                <td>{{ $role->id }}</td>
                                <td>{{ ucfirst(trans($role->name)) }}</td>
                                <td width="10px">
                                    <form action="{{ route('asignarRoles.delete', $role->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Eliminar</button>

                                    </form>


                                </td>
                                <td width="10px">
                                    <form action="{{ route('asignarPermiso.edit', $role->id) }}">
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
@include('crear-rol-modal')
<script src="{{ asset('js/validaciones-formulario.js') }}"></script>