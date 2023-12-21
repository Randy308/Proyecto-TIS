<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reportes Generales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    @include('layouts/estilos')
    
    <style>
        .navbar-custom {
            background-color: #007BFF;
            color: #fff;
        }

        p {
            color: black;
            font-size: 13px;
        }
    </style>
    @livewireStyles
    
</head>

<body>


    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="container mt-5">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-danger" href="{{ route('reportes-generales') }}" type="submit"><i
                            class="bi bi-x-lg"></i></a>
                </div>
                <div class="d-flex  justify-content-center">
                    <h3>Reporte de Evento</h2>
                </div>
            
                @livewire('report-general-mas',['eventoId' => $eventoId])
                
            </div>



        </div>
    </div>
    
    @include('layouts/sidebar-scripts')
    
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- <script>
        $("#BottonFiltrado").on("click", function() {
            $("#filtrosEvento").toggleClass('FiltroInvisible');
        });
    </script> --}}
</body>

</html>
