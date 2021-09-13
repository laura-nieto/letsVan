<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-black py-0 height-100px">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('/img/logo/LOGO-LV.png')}}" alt="" class="w-250">
                    {{-- <span class="color--lets">LET'S</span> VAN --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse fsize-1" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav justify-content-center">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link nav-white" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item ">
                                    <a class="nav-link nav-white" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle nav-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right fsize-1" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('ver_reservas',Auth::id()) }}" class="dropdown-item">
                                        Mis reservas
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
        </nav>
    </header>
    <main>
        @yield('main')
    </main>
    <footer class="bg-black text-white px-3 pt-3 footer-index d-flex flex-column flex-md-row flex-wrap">
        <div class="d-flex justify-content-center justify-content-md-start align-items-center w-15 m-auto m-md-0">
           <img src="{{asset('/img/logo/LOGO-FONDO-NEGRO-LV-2.jpg')}}" alt="" class="w-100">
        </div>
        <div class="d-flex flex-column flex-md-row justify-content-around justify-content-md-start mt-3 mt-md-0 flex-grow-1">
            <div class="mx-auto d-flex align-items-center">
                <div class="d-flex align-items-center mr-5">
                    <i class="fab fa-whatsapp fa-2x mr-2"></i>
                    <p class="m-0">4434489901</p>
                </div>
                <div class="d-flex align-items-center">
                    <i class="far fa-envelope fa-2x mr-2"></i>
                    <p class="m-0">ventas@letsvan.com.mx</p>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center mt-4 mt-md-0">
                <p class="m-0 mr-4">Encuéntranos en:</p>
                <a href="https://www.instagram.com/letsvanmx/" target="_blank" class="text-white mr-4"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="https://www.facebook.com/profile.php?id=100072046007486" target="_blank" class="text-white"><i class="fab fa-facebook-f fa-2x"></i></a>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center mt-3 mt-lg-0 w-100">
            <a href="/terminos-y-condiciones">Terminos y Condiciones</a>
            <a href="/avisos-de-privacidad">Avisos de Privacidad</a>
        </div>
        <div class="w-100 text-center mt-4">
            <small class="m-0">Lets Van &#169 Copyright 2021. Todos los derechos reservados.</small>
        </div>
    </footer>
    @yield('js')
</body>

</html>
