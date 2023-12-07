<!DOCTYPE html>
<html lang="es">

<head>
    <title>Asignar roles</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @include('layouts/estilos')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">

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
                                    <p class="h3">{{ $user->name }}</p>
                                </div>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-auto">
                                            <label for="exampleInputEmail1">Correo electronico:</label>
                                        </div>
                                        <div class="col">
                                            <input type="email" class="form-control" value="{{ $user->email }}"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Enter email" disabled>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-auto">
                                            <label for="exampleInputEmail1" >Estado:</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control"
                                                value="{{ $user->estado }}" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="No existe historial academico"
                                                disabled style="color: {{ $user->estado == 'Habilitado' ? 'green' : 'red' }}">


                                        </div>

                                    </div>
                                </div>




                                <br>
                                @if ($user_roles->count())
                                    <li class="list-group-item"><strong>Roles:</strong>
                                        @foreach ($user->getRoleNames() as $item)
                                            {{ ucfirst(trans($item)) }}
                                            @if (!$loop->last)
                                                ,
                                            @else
                                                .
                                            @endif
                                        @endforeach

                                    </li>
                                @else
                                    <p class="h6">No existe roles asignados a este usuario</p>
                                @endif
                                <br>
                                <div class="card">

                                    <div class="card-body">
                                        <p class="h4">Seleccione los roles a asignar.-</p>
                                        <form action="{{ route('asignarRoles.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex gap-3 flex-column p-4">
                                                @foreach ($roles as $role)
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="radio" id="flexCheckDefault{{$role->id }}"
                                                        value="{{ $role->name }}" name="name[]"
                                                        @if ($user->getRoleNames()->contains($role->name)) checked @endif>
                                                    <label class="form-check-label" for="flexCheckDefault{{$role->id }}">
                                                        {{ucfirst(trans( $role->name)) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                            </div>
                                            <div class="d-flex flex-wrap  gap-3 justify-content-around">
                                                <button type="submit" id="btnAssignRole" class="btn btn-primary">Asignar roles</button>
                                                <input type="button" value="Regresar" class="btn btn-secondary"
                                                    onclick="history.back()">
                                            </div>

                                        </form>



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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        $("#btnAssignRole").on("click", function(e) {
            e.preventDefault();
            if (confirm("¿Está seguro de cambiar el rol a este usuario?")) {
                var form = $(this).parents('form:first');
                form.submit();
            }
        });
    </script>
</body>

</html>
