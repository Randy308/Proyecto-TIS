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
        <div id="content">
            @include('layouts/navbar')
            <br>
           <div class="container border">
            <div class="row">
                <div class="col-md-12 text-center">
                    <br>
                    <h3>Competencia Latinoamericana de Programación  ICPC por TECH-BIRD</h3>
                    <img class="img-fluid  mx-auto" decoding="async" width="682" height="341" src="https://www.umss.edu.bo/wp-content/uploads/2023/03/portada_lat_icpc.png" data-src="https://www.umss.edu.bo/wp-content/uploads/2023/03/portada_lat_icpc.png" alt="" title="portada_lat_icpc" >
                    <br>
                    <div class="mt-4 text-left" >
                        La Competencia Internacional de Programación Universitaria (ICPC por sus siglas en inglés) se inicia en 1970, cuando los pioneros de Alpha Chapter de la “Sociedad de honor de ciencias en computación” (UPE) presentaron la primera competencia de este estilo. La iniciativa se propagó rápidamente hacia los Estados Unidos y Canadá como un programa de innovación para incrementar ambición, aptitud de resolución de problemas, y la oportunidad para estudiantes fuertes en el campo de la computación.

                            Con el tiempo, el concurso se convirtió en una competencia de varios niveles con la primera ronda de campeonato realizada en 1977; desde entonces el concurso se ha expandido a una colaboración mundial de universidades que albergan competencias regionales que hacen avanzar a los equipos a la ronda final anual del campeonato mundial, el ICPC World Finals.
                    </div>
                    <img class="img-fluid  mx-auto" decoding="async"  src="https://www.umss.edu.bo/wp-content/uploads/2023/03/ICPC-world-finals-2021-team-UMSS-2.png" data-src="https://www.umss.edu.bo/wp-content/uploads/2023/03/ICPC-world-finals-2021-team-UMSS-2.png" alt="" >
                    <div class="mt-4 text-left">
                        
                        El concurso fomenta la creatividad, el trabajo en equipo y la innovación en la creación de nuevos programas de software y permite a los estudiantes evaluar su capacidad para desempeñarse bajo presión. El concurso ha elevado las aspiraciones y el rendimiento de generaciones de solucionadores de problemas del mundo en ciencias de la computación
                        e ingenieŕıa.
                        
                        Los participantes conforman equipos de tres personas utilizando una sola computadora, cada equipo representa a su universidad y país respectivamente. El concurso dura cinco horas, tiempo en que los estudiantes deben resolver de ocho a trece problemas algoŕıtmicos. Un equipo es ganador cuando éste resuelve la mayor cantidad de problemas con el menor tiempo de penalización.
                        
                        Las competencias de programación se desarrollan en distintos países y en distintas etapas. Desde el año 2006 Bolivia se ha convertido en una sede oficial de esta competencia tan reconocida, siendo a la fecha la sede de sudamerica mas numerosa. La Universidad Mayor de San Simón participa de estas competencias desde el 2006, habiendo logrado sitiales importantes en el medallero del nodo Bolivia.
                        
                        Es importante la participación de la UMSS en estas competencias, ya que al ser un evento de repercusión mundial, permite posicionar a la Universidad y sus estudiantes en el mapa de las competencias, abriéndoles puertas a trabajos a nivel nacional e internacional, por otro lado permite que los estudiantes interesados participen de una competencia sana, abierta y a nivel académico, lo que obliga a mejorar los conocimientos y destrezas de este grupo de estudiantes. Con el pasar de los años, el nivel de los equipos de Bolivia ha mejorado, en particular equipos de la UMSS han demostrado gran rendimiento.
                        
                    
                    </div>

                    <h4 class="mt-4 text-left">Breve descripción del desarrollo de la competencia</h4>
                    <div class="mt-4 text-left">La competencia de programación tiene diferentes etapas: las competencias internas en las universidades, la competencia de nivel Nacional, los clasificados de esta contienda a nivel Nacional son invitados a participar en la competencia Latinoamericana.

                        La competencia Latinoamericana se desarrolla de manera distribuida por toda Sud-Centro América. El nodo Bolivia pertenece a la zona Sud-Sud América junto a los nodos de la Argentina, Chile y Perú.
                        
                        Cada año la sede de esta competencia Latinoamericana se desarrolla en distintas ciudades y universidades del país.
                        
                        En el desarrollo de la competencia los equipos de estudiantes realizan un calentamiento que involucra el uso de los ambientes de programación y el contacto con el juez virtual resolviendo problemas sencillos. Este calentamiento es una simulación liviana de la competencia y tiene una duración de una hora.
                        
                        La competencia se realiza al día siguiente del calentamiento. Los equipos competidores se aíslan en una estación de trabajo por cinco horas para resolver entre 10 y 12 problemas computacionales que varían en complejidad y requerimientos de eficiencia. Al final de la competencia se conoce el resultado de la competencia siendo vencedor aquel equipo que resolvió más problemas, para desempatar posiciones se utiliza el tiempo que usan para conseguir una resolución correcta y eficiente, siendo penalizados con 20 minutos por entregas que resultan en programas que no alcanzan a funcionar correctamente o no cumplen los requerimientos de eficiencia del problema.
                    </div>

                    <h4  class="mt-4 text-left">La UMSS en el ICPC</h4>
                    <div class="mt-4 text-left">
                        El 17 y 18 de marzo del 2023, la UMSS es la sede de la Competencia Latinoamericana ICPC-2022. Esta invitación, en las condiciones actuales post-pandemia es también realizada por la confianza que ICPC-Bolivia tiene en el Departamento de Informática-Sistemas y su personal académico que en gestiones pasadas realizó una excelente organización de este evento los años 2008 y 2012. Este año la UMSS recibirá la participación de 70 equipos de todo el país para este gran evento académico.    
                    </div> 
                    
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
                    <div class="mt-4 text-left">
                        La Universidad Mayor de San Simón, participa desde el 2006 en esta actividad tan prestigiosa a nivel mundial, destacándose en cada competencia por los puestos alcanzados por los equipos de la UMSS, y por la buena organización en las ocasiones que a la UMSS le tocó recibir a los equipos del nodo Bolivia en el ICPC Latinoamericano en pasadas gestiones.

Los equipos de la UMSS alcanzaron a participar en dos ocasiones en los campeonatos mundiales del ICPC en los años 2017 (<a class="link-opacity-100" href="https://www.lostiempos.com/tendencias/tecnologia/20161115/estudiantes-umss-clasifican-mundial-programacion-eeuu">https://www.lostiempos.com/tendencias/tecnologia/20161115/estudiantes-umss-clasifican-mundial-programacion-eeuu</a>) y 2021 (<a class="link-opacity-100" href="https://www.facebook.com/tiempouniversitarioumss/posts/2119284724886698/">https://www.facebook.com/tiempouniversitarioumss/posts/2119284724886698/</a>)

Es importante destacar ademas que, la Universidad a través del Departamento de Informática – Sistemas participa tambien como Comité de las Olimpiadas de Informática de las Olimpiadas Cientificas del Estado Plurinacionla de Bolivia – OCEPB (Olimpiada Boliviana de Informática – OBI), y una de las actividades es la toma de examenes a los distintos competidores a nivel colegial. Estos exámenes requieren del uso de laboratorios de cómputo y de infraestructura de red además de servidores para una adecuada y correcta realización de estos eventos.

En el cotidiano la formación de profesionales en el área de ciencias de la computación, la existencia de estos laboratorios con las condiciones adecuadas, repercutirá positivamente en la didáctica y la práctica.
                    </div>
                </div>
                    

                  

                    
             </div>

            </div>
  
            <footer>
                <p>Laravel {{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
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
