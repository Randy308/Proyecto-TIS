<link rel="stylesheet" href="{{ asset('css/notificaciones.css') }}">
<nav class="navbar navbar-expand" id="miNavbar">
    <!-- Brand -->
    <button type="button" id="sidebarCollapse" class="btn btn-dark">
        <i class="bi bi-three-dots-vertical"></i>

    </button>

    <!-- Links -->
    <ul class="navbar-nav" id="listaNavbar">
        @auth



             @livewire('notificaciones-resumen')

            <li class="nav-item dropdown" id="navdropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ auth()->user()->foto_perfil}}"
                        width="40" height="40" class="rounded-circle">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <button class="dropdown-item" disabled>{{ auth()->user()->name }}</button>
                     <a class="dropdown-item" href="{{ route('editarPerfil') }}">Editar Perfil</a>
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
@livewireScripts