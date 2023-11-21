<div>
    {{-- The best athlete wants his opponent at his best. --}}
    {{-- {"id":1,"user_id":1,"nombre_evento":"Ipsa unde itaque assumenda.","descripcion_evento":"Molestias sapiente esse nihil veniam ipsam.","estado":"Activo","categoria":"Ciencia de datos","fecha_inicio":"2023-11-22","fecha_fin":"2023-12-17","direccion_banner":"\/storage\/image\/img-default.jpeg","latitud":-17.393599893481,"longitud":-66.145963539153,"background_color":"#FFFF","created_at":"2023-11-19T14:59:21.000000Z","updated_at":"2023-11-19T14:59:21.000000Z"} --}}
    @if (!empty($evento))
        <div class="content pt-5 p-5 m-5 m-sm-0 p-auto-0" id="miContent">
            <div class="container p-5 p-sm-0" id="miContainer">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="polygono1"></div>
                            </div>
                            <div class="col p-4 d-flex justify-content-center">
                                <div class="imagen-container">
                                    <img src="/storage/image/icpc.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                  </div>
                            </div>
                            {{-- <div class="col">
                                <img src="{{ $evento->direccion_banner }}" alt="" height="200px" width="200px">
                            </div> --}}

                        </div>
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="polygono4"></div>
                            </div>
                            <div class="col p-4">
                                <p class="h3 tituloEvento">{{ $evento->nombre_evento }}</p>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore odio ipsa dolor
                                    soluta voluptatum minus, consequatur quam architecto, explicabo in necessitatibus
                                    quisquam deserunt! Delectus quibusdam expedita quod quos ut facere.</p>
                            </div>

                        </div>
                        <div class="row ">
                            <div class="col p-4">
                                <p class="h6 cardEvento">{{ $evento->descripcion_evento }}</p>
                                <span>Fecha: <span class="h6 ">{{ $mifechaFinal }}</span></span>
                                <p class="h6 ">{{ $evento->user->name }}</p>
                                <p class="h6 ">{{ $evento->user->email }}</p>
                                <p class="h6 ">{{ $evento->tiempo_inicio }}</p>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore odio ipsa dolor
                                    soluta voluptatum minus, consequatur quam architecto, explicabo in necessitatibus
                                    quisquam deserunt! Delectus quibusdam expedita quod quos ut facere.</p>
                            </div>
                            <div class="col-md-auto d-flex justify-content-end">
                                <div class="polygono2"></div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="polygono3"></div>
                            </div>
                            <div class="col p-4">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore odio ipsa dolor
                                    soluta voluptatum minus, consequatur quam architecto, explicabo in necessitatibus
                                    quisquam deserunt! Delectus quibusdam expedita quod quos ut facere.</p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="polygono4"></div>
                            </div>
                            <div class="col p-4">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore odio ipsa dolor
                                    soluta voluptatum minus, consequatur quam architecto, explicabo in necessitatibus
                                    quisquam deserunt! Delectus quibusdam expedita quod quos ut facere.</p>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer p-0" id="CardFooter" >
                        <div class="row ">
                            <div class="col ">
                                <div class="date_content p-4" id="miFooter">
                                    <h2>Falta Poco</h2>
                                    <p id="demo"></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>


        <script>
            // Set the date we're counting down to
            var countDownDate = new Date('{{ $evento->fecha_inicio }}' + ' ' + '{{ $evento->tiempo_inicio }}').getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                    minutes + "m " + seconds + "s ";

                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
            }, 1000);
        </script>
    @endif
</div>
