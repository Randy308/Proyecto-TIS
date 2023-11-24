@extends('fase-clasificacion')
@section('contentxd')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nro#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Estado</th>
                <th scope="col">Puntaje</th>
                <th scope="col">FechaInicio</th>
                <th scope="col">FechaFin</th>
            </tr>
        </thead>
        <tbody>
            @php
                use Carbon\Carbon;
                $fechaString = Carbon::now()->toDateString();
                $fechaFormateada = Carbon::createFromFormat('Y-m-d', $fechaString);
            @endphp
            @foreach($fases as $fase)
            <tr>
                <th scope="row">1</th>
                <td>{{$fase->nombre}}</td>
                <td>
                    @if($fechaFormateada->lt($fase->fechaIni))
                    {{$fechaFormateada}}
                    {{$fase->fechaIni}}
                    @elseif($fechaFormateada->gt($fase->fechaFin))
                    {{$fechaFormateada}}
                    {{$fase->fechaIni}}
                    @else
                        En curso
                    @endif
                </td>
                
                <td>?</td>
                <td>{{$fase->fechaIni}}</td>
                <td>{{$fase->fechaFin}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
