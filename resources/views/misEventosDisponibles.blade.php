<!DOCTYPE html>
<html lang="es">

<head>
    <title>Eventos disponibles</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @include('layouts/estilos')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-query.css') }}">
    @livewireStyles
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="col py-3">
                <div class="container py-5 h-100">
                    <main>
                        <div class="card">

                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-2">
                                    <p class="h3">{{ $miColaborador->name }}</p>
                                </div>

                                <div class="container p-4">
                                    <div class="row">
                                        <div class="col-md-auto">
                                            <label for="exampleInputEmail1">Correo electronico:</label>
                                        </div>
                                        <div class="col">
                                            <input type="email" class="form-control"
                                                value="{{ $miColaborador->email }}" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Enter email" disabled>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-auto">
                                            <label for="exampleInputEmail1">Estado:</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control"
                                                value="{{ $miColaborador->estado }}" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="No existe estado"
                                                disabled
                                                style="color: {{ $miColaborador->estado == 'Habilitado' ? 'green' : 'red' }}">


                                        </div>

                                    </div>
                                </div>
                                <div class="m-4">
                                    @if ($miColaborador->eventosColabora->count())
                                    <li class="list-group-item"><strong>Eventos:</strong>
                                        @foreach ($miColaborador->eventosColabora as $item)
                                            {{ ucfirst(trans($item->nombre_evento)) }}
                                            @if (!$loop->last)
                                                ,
                                            @else
                                                .
                                            @endif
                                        @endforeach

                                    </li>
                                @else
                                    <p class="h6">No existe eventos para colaborar asignados a este usuario</p>
                                @endif
                                </div>
                                <div class="card">

                                    <div class="card-body">
                                        <p class="h6">Seleccione el eventos para asignar como colaborador.-</p>
                                        @if ($eventos->count())
                                            <form action="{{ route('colaboradores.store', ['user' => auth()->user()->id , 'colaborador' => $miColaborador->id]) }}" method="POST">
                                                @csrf

                                                <div class="d-flex gap-3 flex-column p-4">
                                                    @foreach ($eventos as $evento)
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="flexCheckDefault{{ $evento->id }}"
                                                                value="{{ $evento->id }}" name="eventos[]"
                                                                @if ($miColaborador->eventosColabora->contains($evento)) checked disabled @endif>
                                                            <label class="form-check-label"
                                                                for="flexCheckDefault{{ $evento->id }}">
                                                                {{ ucfirst(trans($evento->nombre_evento)) }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="d-flex flex-wrap  gap-3 justify-content-around">
                                                    <button type="submit" class="btn btn-primary">Vincular con
                                                        eventos</button>

                                                        <a href="{{ route('colaboradores.index') }}" class="btn btn-secondary" >Regresar</a>
                                                </div>

                                            </form>
                                        @else
                                         <p class="h5">No existen eventos disponibles para asignar colaborador</p>
                                        @endif




                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>

    </div>


    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')


</body>

</html>
