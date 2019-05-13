

<header class="app-header navbar navbar-dark bg-gray-dark">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="fa fa-bars"style="color:white"></span>
    </button>

    <a class="navbar-brand" href="{{route('home')}}">
        <img class="navbar-brand-full" src="{{asset('images/Guardian_completo.svg')}}" width="125" height="50" alt="A2ESCOM Logo">
        <img class="navbar-brand-minimized" src="{{asset('images/Guardian.svg')}}" width="40" height="40" alt="A2ESCOM Logo">
    </a>
    <!--
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="img/brand/logo.svg" width="89" height="25" alt="CoreUI Logo">

    </a>
    -->
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="fa fa-bars"style="color:white"></span>
    </button>

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link " href="{{route('Usuarios.index')}}" >Usuarios</a>
        </li>

        <li class="nav-item px-3">
            <a class="nav-link " href="">Cursos</a>
        </li>

    </ul>

    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown d-sm-down-none" data-toggle="tooltip" data-placement="left" title="Notificaciones">
            <a class="nav-link" href="#" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-warning"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header list-inline">
                    <a class="text-right font-weight-bold list-inline-item">Notificaciones</a>
                    <a class="text-left list-inline-item" href="#">Marcar como leidas</a>
                </div>
                <div class="dropdown-item-text bg-light"><small class="font-weight-bold">Nuevas</small></div>

            </div>
        </li>
        <li class="nav-item dropdown px-3">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="{{asset('images/img.jpg')}}">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Bienvenido {{Auth::user()->name}}</strong>
                </div>
                <a class="dropdown-item d-md-none " href="#">
                    <i class="fa fa-bell-o"></i> Notificaciones
                    <span class="badge badge-info">42</span>
                </a>

                <div class="dropdown-header text-center d-md-none">
                    <strong>Configuración</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-user"></i> Perfil</a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-wrench"></i> Opciones</a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i>{{__('Logout')}}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>



</header>

