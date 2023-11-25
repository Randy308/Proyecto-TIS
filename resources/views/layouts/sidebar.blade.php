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
                    @can('organizador.crear-evento')
                        <li>
                            <a href="{{ route('crear-evento') }}">Crear Evento</a>
                        </li>
                    @endcan
                    @can('organizador.ver-mis-eventos')
                        <li>
                            <a href="{{ route('misEventos') }}">Mis eventos</a>
                        </li>
                    @endcan
                @endauth
                <li>
                    <a href="{{ route('listaEventos') }}">Lista de Eventos</a>
                </li>
            </ul>
        </li>
        @auth
            @can('admin.listar-todos-usuarios')
                <li>
                    <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="bi bi-people-fill"></i>
                        <span>Usuarios</span>
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu2">


                        <li>
                            <a href="{{ route('listaUsuarios') }}">Lista de Usuarios</a>
                        </li>
                        @can('admin.crear-usuario')
                            <li>
                                <a href="{{ route('crearUsuario') }}">Crear Usuario</a>
                            </li>
                        @endcan


                    </ul>
                </li>
            @endcan



            @can('admin.crear-auspiciador')
                <li>
                    <a href="{{ route('auspiciadores-index') }}">
                        <i class="bi bi-cup-hot"></i>
                        <span>Auspiciadores</span>
                    </a>
                </li>
            @endcan
            @can('admin.ver-roles')
                <li>
                    <a href="{{ route('asignarRoles') }}">
                        <i class="bi bi-person-rolodex"></i>
                        <span>Roles</span>
                    </a>
                </li>
            @endcan
            <li>
                <a href="{{ route('colaboradores.index') }}">
                    <i class="bi bi-person-heart"></i>
                    <span>Colaboradores</span>
                </a>
            </li>

        @endauth

    </ul>

    <ul class="list-unstyled CTAs">

    </ul>

</nav>
