<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Menu Lateral</h3>
        <strong><i class="bi bi-menu-down"></i></strong>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="{{ route('index') }}">
                <i class="bi bi-house"></i>
                <span>Inicio</span>
            </a>
        </li>
        <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-calendar-event"></i>
                <span>Eventos</span>
            </a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                @auth
                    <li>
                        <a href="{{route('crear-evento')}}">Crear Evento</a>
                    </li>
                    <li>
                        <a href="{{ route('misEventos') }}">Mis eventos</a>
                    </li>
                @endauth
                <li>
                    <a href="{{ route('listaEventos') }}">Lista de eventos</a>
                </li>
            </ul>
        </li>
        @include('layouts.sidebar-component')
    </ul>

    <ul class="list-unstyled CTAs">

    </ul>

</nav>
