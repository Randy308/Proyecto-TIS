<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    @include('layouts/estilos')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="wrapper">
        @include('layouts/sidebar')
        <div id="content">
            @include('layouts/navbar')
            <div class="col py-3">
                <div class="container py-5 h-100">
                    <main>
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1">Crear Rol</p>

                                <form class="mx-1 mx-md-4"
                                    action='{{ route('asignarRoles.store') }}' method="POST"
                                    h>
                                    @csrf
                                    <div class="form-outline">
                                        <label class="form-label" for="form3Examplev2">Nombre
                                            del rol</label>
                                        <input type="text" name="rol" id="rol"
                                            class="form-control "
                                            class="@error('rol') is-invalid @enderror" />
                                        @error('rol')
                                            <small>{{ $message }}</small>
                                        @enderror

                                    </div>

                                    <br>

                                    <div class="form-outline">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg">Guardar</button>
                                    </div>

                                </form>

                            </div>

                        </div>
                        <div>
                            @livewire('role-index')
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
