<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts/estilos')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-query.css') }}">
    @livewireStyles
</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        
        <div id="content" >
            @include('layouts/navbar')
            <br>
           <div class="container border">
            <main>
                <section id="acerca" class="py-5">
                    <div class="container">
                        <h2>Acerca del ICPC</h2>
                        <img src="https://www.umss.edu.bo/wp-content/uploads/2023/03/portada_lat_icpc.png" alt="">
                        <span>El Concurso Internacional de Programación Universitaria es un concurso de programación algorítmica para estudiantes universitarios. Equipos de tres, que representan a su universidad, trabajan para resolver los problemas más reales, fomentando la colaboración, la creatividad, la innovación y la capacidad de desempeñarse bajo presión. A través del entrenamiento y la competición, los equipos se desafían entre sí para elevar el listón de lo posible. Sencillamente, es el concurso de programación más antiguo, más grande y más prestigioso del mundo.</span>
                    </div>
                </section>
                <section id="acerca" class="py-5">
                    <div class="container">
                        <h2>La UMSS en el ICPC</h2>
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <img decoding="async" width="600" height="450" src="https://www.umss.edu.bo/wp-content/uploads/2023/03/icpc-latino-2008-sede-umss-staff-.png" alt="" class="img-fluid">
                                </div>
                                <div class="col-md-4">
                                    <img decoding="async" width="600" height="402" src="https://www.umss.edu.bo/wp-content/uploads/2023/03/icpc-umss-team-2012.png" alt="" class="img-fluid">
                                </div>
                                <div class="col-md-4">
                                    <img decoding="async" width="600" height="450" src="https://www.umss.edu.bo/wp-content/uploads/2023/03/ICPC-world-finals-2017-team-UMSS.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <span>La Universidad Mayor de San Simón, participa desde el 2006 en esta actividad tan prestigiosa a nivel mundial, destacándose en cada competencia por los puestos alcanzados por los equipos de la UMSS, y por la buena organización en las ocasiones que a la UMSS le tocó recibir a los equipos del nodo Bolivia en el ICPC Latinoamericano en pasadas gestiones.</span>
                    </div>
                </section>
                
            </main>
        
            <footer class="text-center py-4">
                <p>Realizado por TECHBIRD &copy; 2023</p>
            </footer>
        </div>

    </div>


    @include('layouts/sidebar-scripts')
    @include('layouts.mensajes-alerta')
    @livewireScripts
    <script>
        function myFunction(x) {
            if (x.matches) { // If media query matches
                //document.body.style.backgroundColor = "yellow";
                $( "#miContent" ).removeClass( "p-5" );
                $( "#miContent" ).removeClass( "m-5" );
                $( "#miContainer" ).removeClass( "p-5" );
                $( "#miContainer" ).removeClass( "m-5" );
            } else {

                // $( "#miContent" ).addClass( "p-5" );
                // $( "#miContent" ).addClass( "m-5" );
                // $( "#miContainer" ).addClass( "p-5" );
                // $( "#miContainer" ).addClass( "m-5" );
                //document.body.style.backgroundColor = "pink";
            }
        }

        var x = window.matchMedia("(max-width: 700px)")
        myFunction(x) // Call listener function at run time
        x.addListener(myFunction) // Attach listener function on state changes

    </script>

</body>

</html>
