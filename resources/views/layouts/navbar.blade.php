<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">System Admin</a>
        </div>
        <ul class="nav navbar-nav">
            <?php
                $user_active = "";
                $role_active = "";
                $action_active = "";

                if( str_contains(request()->url(), "usuario") )
                {
                    $user_active = "active";
                }
                if( str_contains(request()->url(), "rol") )
                {
                    $role_active = "active";
                }
                if( str_contains(request()->url(), "accion") )
                {
                    $action_active = "active";
                }
            ?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sistema
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class="{{ $user_active }}" ><a href="{{ url('usuario/listar') }}">Usuarios</a></li>
                  <li class="{{ $role_active }}" ><a href="{{ url('rol/listar') }}">Roles</a></li>
                  <li class="{{ $action_active }}" ><a href="{{ url('accion/listar') }}">Acciones</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Asignaciones
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class="{{ $user_active }}" ><a href="{{ url('usuario/listar') }}">Usuarios</a></li>
                  <li class="{{ $role_active }}" ><a href="{{ url('rol/listar') }}">Roles</a></li>
                  <li class="{{ $action_active }}" ><a href="{{ url('accion/listar') }}">Acciones</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('login') }}"><span class="glyphicon glyphicon-log-in"></span>Iniciar Sesión</a></li>
        </ul>
    </div>
</nav>
