<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Menu Lateral</h3>
        <strong>TB</strong>
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
                <li>
                    <a href="{{route('crear-evento')}}">Crear Evento</a>
                </li>
                <li>
                    <a href="#">Modificar evento</a>
                </li>
                <li>
                    <a href="{{ route('listaEventos')}}">Lista de eventos</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-speedometer"></i>
                <span>Dashboard</span>
            </a>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-flag-fill"></i>
                <span>Competencias</span>
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Crear competencia</a>
                </li>
                <li>
                    <a href="#">Modificar competencia</a>
                </li>
                <li>
                    <a href="#">Lista de competencias</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-person-fill-add"></i>
                <span>Registrar Usuarios</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-door-open"></i>
                <span>Iniciar Sesion</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-envelope"></i>
                <span>Mensajes</span>
            </a>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">

    </ul>

</nav>
