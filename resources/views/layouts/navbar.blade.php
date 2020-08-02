<!-- Always shows a header, even in smaller screens. -->
<div class="navbar-fixed">
    <nav class="blue-grey darken-4">
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo"><a href="{{ route('welcome') }}">
                    <img src="{{ asset('/img/logo_white.svg') }}" alt="logo-pasante" height="100%"
                        style="padding: 10px">
                </a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    @auth
                    @if(Auth::user()->hasRole('admin'))
                    <li><a href="sass.html">Permisos</a></li>
                    @endif
                    @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('agent'))
                    <li><a href="{{ route('add_files') }}">Agregar Archivos</a></li>
                    @endif
                    @if(Auth::user()->hasRole('user'))
                    <li><a href="{{ route('judicial') }}">Expedientes</a></li>
                    @endif
                    @endauth
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i
                                class="material-icons">more_vert</i></a></li>
                </ul>
        </div>
    </nav>
</div>
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
    @guest
    <li><a href="{{ route('login') }}"><i class="material-icons">login</i> Iniciar Sesión</a></li>
    <li><a href="{{ route('register') }}"><i class="material-icons">person_add</i> Crear Cuenta</a></li>
    <li class="divider"></li>
    @endguest
    @auth
    <li><a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a></li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endauth
</ul>

<!-- Side Nav Structure -->

<ul id="slide-out" class="sidenav">
    @auth
    <li>
        <div class="user-view">
            <!--div class="background">
                <img src="" alt="image-profile">
            </div-->
            <a href="#user"><img class="circle" src="{{ asset('/img/img-user.svg') }}"></a>
            <a href="#name"><span class="blue-grey-text text-darken-4 name">{{ Auth::user()->name }}</span></a>
            <a href="#email"><span class="blue-grey-text text-darken-4 email">{{ Auth::user()->email }}</span></a>
        </div>
    </li>
    @if(Auth::user()->hasRole('admin'))
    <li><a href="#!"><i class="material-icons">how_to_reg</i>Permisos</a></li>
    @endif
    @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('agent'))
    <li><a href="{{ route('add_files') }}"><i class="material-icons">cloud_upload</i>Subir Archivos</a></li>
    @endif
    @if(Auth::user()->hasRole('user'))
    <li><a href="{{ route('judicial') }}"><i class="material-icons">folder</i>Expedientes</a></li>
    @endif
    <li>
        <div class="divider"></div>
    </li>
    <li><a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                class="material-icons">exit_to_app</i>Salir</a></li>
    @endauth
    @guest
    <li><a href="{{ route('login') }}"><i class="material-icons">login</i>Iniciar Sesión</a></li>
    <li><a href="{{ route('register') }}"><i class="material-icons">person_add</i>Crear Cuenta</a></li>
    @endguest
</ul>