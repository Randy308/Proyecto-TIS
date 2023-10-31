<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Evento</title>
    @include('layouts/estilos')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')

            <div class="container">
                <h1>Asignar Roles</h1>
                <form method="POST" action="{{ route('assign-role') }}">
                    @csrf
                    <div class="form-group">
                        <label for="user_id">Seleccionar Usuario:</label>
                        <select name="user_id" id="user_id" class="form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Seleccionar Rol:</label>
                        <select name="role" id="role" class="form-control">
                            <option value="administrador">Administrador</option>
                            <option value="organizador">Organizador</option>
                            <option value="colaborador">Colaborador</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Asignar Rol</button>
                </form>
            </div>


        </div>
    </div>

    @include('layouts/sidebar-scripts')
</body>

</html>
