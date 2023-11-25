<div class="container pt-4 mt-4">
    <div class="row">

        <div class="col-md-12 mb-3">
            <label for="">Búsqueda por Nombre</label>


            <div class="input-group mb-3">

                <input wire:model="search" type="text" class="form-control" placeholder="Buscar...">
            </div>
        </div>
    </div>

    @if ($usuarios->count())
        <div class="card-body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $user)
                        <tr>
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
                                            <a href="{{ route('colaboradores.asignar', ['user' => auth()->user()->id , 'colaborador' => $user->id]) }}" class="dropdown-item"> Vincular a Evento</a>
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
            $(".boton-eliminar").on("click", function(e) {
                e.preventDefault();
                if (confirm("¿Está seguro de eliminar a este usuario?")) {
                    var form = $(this).parents('form:first');
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
