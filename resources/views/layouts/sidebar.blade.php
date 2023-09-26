<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Menu Lateral</h3>
        <strong>TB</strong>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="#">
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
                    <a href="#" data-toggle="modal" data-target="#exampleModal">Crear evento</a>
                </li>
                <li>
                    <a href="#">Modificar evento</a>
                </li>
                <li>
                    <a href="#">Lista de eventos</a>
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
    <div class="dropdown pb-4">
        <a class="d-flex align-items-center text-decoration-none dropdown-toggle" type="button" id="dropdownMenuButton"
            data-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="hugenerd" width="50" height="50" class="rounded-circle">
            
        </a>
        <div class="dropdown-menu text-small caja" aria-labelledby="dropdownMenuButton">
            <li><span class="d-none d-sm-inline mx-1">Admin</span></li>
            <li><a class="dropdown-item" href="#">Ajustes</a></li>
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <button type="submit" class="dropdown-item">Cerrar sesión</button>
            </li>
        </div>
    </div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Titulo:</label>
                        <input type="text" name="titulo" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Descripcion:</label>
                        <textarea name="descripcion" class="form-control" id="message-text"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Subir imagen:</label>
                        <input type="file" name="file" >
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Estado:</label>
                        <textarea class="form-control" name="estado" id="estado-text"></textarea>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="fecha-inicio" class="col-form-label">Fecha de inico:</label>
                          <input type="date" name="fechainicio" class="form-control" id="fecha-inicio" placeholder="First name">
                        </div>
                        <div class="col">
                            <label for="fecha-fin" class="col-form-label">Fecha final:</label>
                          <input type="date" name="fechafin" class="form-control" id="fecha-fin" placeholder="Last name">
                        </div>
                      </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Agregar Evento</button>
            </div>
        </div>
    </div>
</div>
