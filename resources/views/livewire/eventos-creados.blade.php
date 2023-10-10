<div>
    {{-- In work, do what you enjoy. --}}
    <div>
        <p>{{ $user->email }}</p>
        @if ($eventos->count())

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Evento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventos as $evento)
                            <tr>

                                <td>{{ $evento->id }}</td>
                                <td>{{ $evento->nombre_evento }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
    </div>

</div>
