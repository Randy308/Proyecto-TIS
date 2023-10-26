<nav class="navbar navbar-expand" id="miNavbar">
    <!-- Brand -->
    <button type="button" id="sidebarCollapse" class="btn btn-dark">
        <i class="bi bi-three-dots-vertical"></i>

    </button>

    <!-- Links -->
    <ul class="navbar-nav" id="listaNavbar">
        @auth

            <li class="nav-item"><a href="#" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                        height="30" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path
                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                    </svg></a>
            </li>

            <li class="nav-item dropdown" id="navdropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('storage/image/images.jpg') }}"
                        width="40" height="40" class="rounded-circle">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <button class="dropdown-item" disabled>{{ auth()->user()->email }}</button>

                    <!--
                                 <a class="dropdown-item"  disabled >Configuracion</a>
                                <a class="dropdown-item" href="#">Editar Perfil</a>
                            -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Cerrar sesión</button>
                    </form>

                </div>
            </li>

        @endauth
        @guest
            <li class="nav-item dropdown">
                <a class="nav-item" href="#" role="button" data-toggle="modal" data-target="#loginModal"  class="btn btn-link">
                    Iniciar Sesión
                </a>

            </li>
            @include('iniciar-sesion')
        @endguest
    </ul>
</nav>
