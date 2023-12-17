<div><br>
    <table class="table">
        <thead>
            <tr>
                <th>Fase</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fases as $fase)
                <tr>{{--fila--}}
                    <td>{{$fase->nombre_fase}}</td>
                    <td>{{$fase->fechaInicio}}</td>
                    <td>{{$fase->fechaFin}}</td>
                </tr>  
            @endforeach
        </tbody>
    </table>
</div>
