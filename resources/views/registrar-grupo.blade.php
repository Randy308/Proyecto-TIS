<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fases del evento</title>
    @include('layouts/estilos')
    <style>
        .input,
        .textarea {
            border: 1px solid #ccc;
            font-family: inherit;
            font-size: inherit;
            padding: 1px 6px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .input {
            position: absolute;
            width: 100%;
            left: 0;
        }

        .width-machine {
            /*   Sort of a magic number to add extra space for number spinner */
            padding: 0 1rem;
        }
    </style>
    @livewireStyles
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">

            @include('layouts/navbar')
            <div class="container mt-4">

                <div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            <strong>{{ session('status') }}</strong>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                @livewire('registrar-grupo', ['evento_id' => $evento->id])

            </div>
            <div class="container my-4">
                @livewire('user-search', ['evento_id' => $evento->id])
            </div>

        </div>

    </div>
    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    @livewireScripts

</body>

</html>
