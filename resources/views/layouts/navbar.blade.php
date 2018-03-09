<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <ul class="nav navbar-nav">
        @if( Session::get('username') != 'anonymous' )
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
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Asignaciones
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="" ><a href="{{ url('rol/asignando_rol') }}">Asignar roles a usuarios</a></li>
                  <li class="" ><a href="{{ url('accion/asignando_accion') }}">Asignar acciones a roles</a></li>
                </ul>
            </li>
        @endif
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if( Session::get('username') != 'anonymous' )
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Session::get('username') }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="" >
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
            @else
                <li><a href="{{ url('login') }}"><span class="glyphicon glyphicon-log-in"></span>Iniciar Sesión</a></li>
            @endif
        </ul>
    </div>
</nav>
