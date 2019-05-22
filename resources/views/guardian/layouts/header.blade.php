

<header class="app-header navbar navbar-dark bg-gray-dark">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="fa fa-bars"style="color:white"></span>
    </button>

    <a class="navbar-brand" href="{{route('home')}}">
        <img class="navbar-brand-full d-sm-down-none" src="{{asset('images/Guardian_completo.svg')}}" width="125" height="50" alt="A2ESCOM Logo">
        <img class="navbar-brand-full d-md-none" src="{{asset('images/Guardian.svg')}}" width="40" height="40" alt="A2ESCOM Logo">
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
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown d-sm-down-none" data-toggle="tooltip" data-placement="right" title="Notificaciones">
            <a class="nav-link" href="#" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-warning">{{count(Auth::user()->notifications)}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header list-inline">
                    <a class="text-right font-weight-bold list-inline-item">Notificaciones</a>
                    <a class="text-left list-inline-item" href="#">Marcar como leidas</a>
                </div>
                <div class="dropdown-item-text bg-light"><small class="font-weight-bold">Nuevas</small></div>
                @if(count(Auth::user()->unreadNotifications )== 0)
                    <a class="dropdown-item" href="#">
                        <small>No hay Nuevas notificaciones</small>
                    </a>
                @else
                    @foreach(Auth::user()->unreadNotifications  as $notification)
                        <a class="dropdown-item" href="#">
                            <small>{{$notification->data['message']. $notification->data['fragment_key']}}</small>
                        </a>
                    @endforeach
                @endif
            </div>
        </li>
        <li class="nav-item dropdown d-md-none ">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="icon-bell"></i><span class="badge badge-info">{{count(Auth::user()->notifications)}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <h6 class="dropdown-header">Notifications</h6>
                @if(count(Auth::user()->unreadNotifications )== 0)
                    <a class="dropdown-item" href="#">
                        <small>No hay Nuevas notificaciones</small>
                    </a>
                @else
                    @foreach(Auth::user()->unreadNotifications  as $notification)
                        <a class="dropdown-item" href="#"style="max-width: 3px;">
                            <form action="{{route('Archivos.destroy', $notification->data['message'])}}" method="post">
                                @csrf
                                @method('POST')
                                <button  class="btn btn-sm"><small>{{$notification->data['message']}}</small></button>
                            </form>
                        </a>
                    @endforeach
                @endif
            </div>
        </li>
        <li class="nav-item dropdown px-3 ">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <small><strong>{{Auth::user()->name}}</strong></small>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Bienvenido {{Auth::user()->name}}</strong>
                </div>
                <div class="dropdown-header text-center d-md-none">
                    <small><strong>Configuración</strong></small>
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

