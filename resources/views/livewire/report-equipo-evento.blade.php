<div>
    <br>
    @php
        $participantes = \App\Models\Evento::join('asistencia_eventos', 'asistencia_eventos.evento_id', '=', 'eventos.id')
            ->join('users', 'users.id', '=', 'asistencia_eventos.user_id')
            ->select('eventos.id AS evento_id', 'asistencia_eventos.id AS asistencia_eventos_id', 'users.id as user_id', 'users.name as nombreParticipante')
            ->where('eventos.id', $eventoId)
            ->get();
            $evento = \App\Models\Evento::find($eventoId);
    @endphp
    @if (count($equipos) == 0 && count($participantes) == 0 )
     @if ($evento->modalidad == 'individual')
     <div class="alert alert-secondary">
        No existen participantes.
     </div>   
     @else
     <div class="alert alert-secondary">
        No existen equipos.
     </div>
     @endif
    @else
    <table class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                
                @if ($evento->modalidad == 'individual')
                    <th>Participantes</th>
                    <th>Institucion</th>
                @else
                    <th>Equipo</th>
                    <th>Miembros</th>
                    <th>Coach</th>
                    <th>Institucion</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if ($evento->modalidad == 'individual')
                @foreach ($participantes as $participante)
                    <tr style="cursor:default;">
                        <td>{{ $participante->nombreParticipante }}</td>
                        <td>{{ $participante->User->Institucion->nombre_institucion }}</td>
                    </tr>
                @endforeach
            @else
                @foreach ($equipos as $equipo)
                    <tr style="cursor:default;"> {{-- fila --}}
                        <td>{{ $equipo->nombreGrupo }}</td>
                        <td>
                            @php
                                $miembros = \App\Models\PertenecenGrupo::join('users', 'users.id', '=', 'pertenecen_grupos.user_id')
                                    ->select('users.id AS user_id', 'users.name AS nombreParticipante')
                                    ->where('grupo_id', $equipo->grupo_id)
                                    ->get();
                            @endphp
                            <ul>
                                @foreach ($miembros as $miembro)
                                    @if ($equipo->user_id != $miembro->user_id)
                                        <li>
                                            <span class="">{{ $miembro->nombreParticipante }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $equipo->nombreCreadorGrupo }}</td>
                        <td>{{ $equipo->User->Institucion->nombre_institucion }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    @endif
</div>
