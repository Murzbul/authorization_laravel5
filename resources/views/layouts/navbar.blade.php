<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" id="menu-system" data-toggle="dropdown" aria-haspopup="true">Sistema</a>
                  <div class="dropdown-menu bg-dark" aria-labelledby="menu-system">
                    <a href="{{ url('usuario/listar') }}" class="dropdown-item bg-dark text-white">Usuarios</a>
                    <a href="{{ url('rol/listar') }}" class="dropdown-item bg-dark text-white">Roles</a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" id="menu-system" data-toggle="dropdown" aria-haspopup="true">Asignaciones</a>
                  <div class="dropdown-menu bg-dark" aria-labelledby="menu-system">
                    <a class="dropdown-item bg-dark text-white" href="{{ url('rol/asignando_rol') }}">Asignar roles a usuarios</a>
                    <a class="dropdown-item bg-dark text-white" href="{{ url('accion/asignando_accion') }}">Asignar acciones a roles</a>
                  </div>
                </li>
            </ul>
            <form id="logout-form" class="form-inline navbar-nav pr-5" action="{{ route('logout') }}" method="POST">
                @csrf
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" id="menu-system" data-toggle="dropdown" aria-haspopup="true">{{ Session::get('username') }}</a>
                      <div class="dropdown-menu bg-dark" aria-labelledby="menu-system">
                        <input id="logout" type="submit" class="dropdown-item bg-dark text-white" value="Cerrar Sesión">
                      </div>
                    </li>
                </ul>
            </form>
        </div>
    </nav>
</header>
