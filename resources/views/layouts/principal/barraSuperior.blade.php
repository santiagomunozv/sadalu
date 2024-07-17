<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav container-fluid">
        <div class="container-fluid m-auto">
            <h1 class="h3 mb-2 text-gray-800">@yield('nombreModulo')</h1>
        </div>
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span
                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Session::get('session_usr_nombreLogin') }}</span>
                <i class="fas fa-user-circle fa-2x text-info"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                {{-- <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Configuración
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Tareas
                </a>
                <div class="dropdown-divider"></div>  --}}
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Salir
                </a>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="companiaDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-building"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="companiaDropdown">
                @foreach (Session::get('session_usr_companiasAsociadas') as $compania)
                    {{ Form::open(['url' => '/seguridad/cambiocompania', 'method' => 'POST']) }}
                    <button type="submit"
                        class="dropdown-item {{ $compania->idCompania === Session::get('idCompania') ? 'disabled' : '' }}">
                        {{ $compania->nombreCompania }}
                        @if ($compania->idCompania == Session::get('idCompania'))
                            <i class="fas fa-check text-info"></i>
                        @endif
                    </button>
                    <input type="hidden" name="compania" value="{{ $compania->idCompania }}">
                    {{ Form::close() }}
                @endforeach
            </div>
        </li>
    </ul>
</nav>
