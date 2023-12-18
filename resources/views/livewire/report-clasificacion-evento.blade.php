<div><br>
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
                @php
                    $calificacionesevento = \App\Models\CalificacionEvento::where('evento_id', $eventoId)->get();
                @endphp
                @if ($evento->modalidad == 'individual')
                    <th>Participantes</th>
                @else
                    <th>Equipo</th>
                @endif
                <th>institucion</th>
                @foreach ($calificacionesevento as $calificacionevento)
                    <th>{{ $calificacionevento->Calificacion->nombre }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if ($evento->modalidad == 'individual')
                
                @foreach ($participantes as $participante)
                    <tr style="cursor:default;">
                        <td>{{ $participante->nombreParticipante }}</td>
                        <td>{{ $participante->User->Institucion->nombre_institucion }}</td>
                        @php
                            $calificacionesusers = \App\Models\CalificacionUsuario::where('user_id', $participante->user_id)
                                                                                    ->where('evento_id',$participante->evento_id)->get();
                        @endphp
                        @foreach ($calificacionesusers as $calificacionesuser)
                            <td>{{ $calificacionesuser->puntaje }}</td>
                        @endforeach
                    </tr>
                @endforeach
            @else
                @foreach ($equipos as $equipo)
                    <tr style="cursor:default;">{{-- fila --}}
                        <td>{{ $equipo->nombreGrupo }}</td>
                        <td>{{ $equipo->User->Institucion->nombre_institucion }}</td>
                        @php
                            $calificacionesgrupo = \App\Models\CalificacionGrupo::where('grupo_id', $equipo->grupo_id)->get();
                        @endphp
                        @foreach ($calificacionesgrupo as $calificaciongrupo)
                            <td>{{ $calificaciongrupo->puntaje }}</td>
                        @endforeach
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    @endif
</div>
