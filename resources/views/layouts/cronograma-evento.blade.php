<div>
    <table class="table table-bordered table-responsive-sm">
        <thead>
            <tr>
                <th>Modulo</th>
                <th>Descripción</th>
                <th>Desde</th>
                <th>Hasta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fases as $fase)
                <tr @if ($fase->actual == 1) class="table-primary" @endif>


                    @php
                        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

                        $fecha_inicio = \Carbon\Carbon::parse($fase->fechaInicio);
                        $fecha_fin = \Carbon\Carbon::parse($fase->fechaFin);

                        $mes = $meses[$fecha_inicio->format('n') - 1];
                        $mes_fin = $meses[$fecha_fin->format('n') - 1];

                        $hora_inicio = $fecha_inicio->format('H:i A'); // Obtén la hora en formato HH:mm:ss
                        $hora_fin = $fecha_fin->format('H:i A'); // Obtén la hora en formato HH:mm:ss

                        $fecha_inicio = $fecha_inicio->format('d') . ' de ' . $mes . ' del ' . $fecha_inicio->format('Y') . ' a las ' . $hora_inicio;
                        $fecha_fin = $fecha_fin->format('d') . ' de ' . $mes_fin . ' del ' . $fecha_fin->format('Y') . ' a las ' . $hora_fin;
                    @endphp
                    @if ($loop->first)
                        <td>{{ $fase->nombre_fase }}</td>
                        <td></td>
                        <td></td>
                        <td> {{ $fecha_fin }}</td>
                    @endif


                    @if ($loop->last)
                        <td>{{ $fase->nombre_fase }}</td>
                        <td></td>
                        <td> </td>
                        <td> {{ $fecha_fin }}</td>
                    @endif

                    @unless ($loop->first || $loop->last)
                        <td>{{ $fase->nombre_fase }}</td>
                        <td>{{ $fase->descripcion_fase }}</td>
                        <td> {{ $fecha_inicio }}</td>
                        <td> {{ $fecha_fin }}</td>
                    @endunless
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
