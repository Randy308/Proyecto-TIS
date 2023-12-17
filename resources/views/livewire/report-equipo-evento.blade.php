<div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Miembros</th>  
                <th>Coach</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($equipos as $equipo)
                <tr>{{--fila--}}
                    <td>{{$equipo->nombreGrupo}}</td>
                    <td>
                        @php
                            $miembros=\App\Models\PertenecenGrupo::join('users','users.id','=','pertenecen_grupos.user_id')
                                                                    ->select('users.id AS user_id','users.name AS nombreParticipante')
                                                                    ->where('grupo_id',$equipo->grupo_id)
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
                    <td>{{$equipo->nombreCreadorGrupo}}</td>
                </tr>   
            @endforeach
        </tbody>
    </table>
</div>
