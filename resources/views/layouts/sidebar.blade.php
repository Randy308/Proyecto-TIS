<nav id="sidebar">
    <div class="sidebar-header">
        <div class="d-flex justify-content-center">
            <img src="/storage/image/tech-bird-logo.png" alt="logo-tech-bird" id="ImagenLogo"
                style="width: 100px; height: 100%; object-fit: cover;">
        </div>

        <strong><i class="bi bi-layout-text-sidebar"></i></strong>
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
                            <a href="{{ route('misEventos',['tab' => 1]) }}">Mis eventos</a>
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
            @hasanyrole('administrador|organizador')
                <li>
                    <a href="{{ route('colaboradores.index') }}">
                        <i class="bi bi-person-heart"></i>
                        <span>Colaboradores</span>
                    </a>
                </li>
            @endhasanyrole

            {{--reportes--}}            
            @can('admin.ver-reportes')
            <li>
                <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="bi bi-people-fill"></i>
                    <span>Reportes</span>
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu3">

                    @can('admin.ver-reportes-generales')
                    <li>
                        <a href="{{ route('reportes-generales') }}">Reportes Generales</a>
                    </li>    
                    @endcan
                    @can('admin.ver-reportes-especificos')
                    <li>
                        <a href="{{ route('reportes-especificos') }}">Reportes Especificos</a>
                    </li>    
                    @endcan

                </ul>
            </li>    
            @endcan
                
            {{--  --}}

        @endauth

    </ul>

    <ul class="list-unstyled CTAs">

    </ul>

</nav>
