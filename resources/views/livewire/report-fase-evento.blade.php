<div><br>
    <table class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th>Fase</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fases as $fase)
                <tr style="cursor:default;">{{--fila--}}
                    <td>{{$fase->nombre_fase}}</td>
                    <td>{{$fase->fechaInicio}}</td>
                    <td>{{$fase->fechaFin}}</td>
                </tr>  
            @endforeach
        </tbody>
    </table>
</div>
