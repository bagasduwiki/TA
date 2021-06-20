<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('images/LOGO himatika 2019.png')}}"
          type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset ('vendor/fontawesome-free/css/all.min.css')}}">
    <script src="{{ asset ('vendor/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<style>
    /*a:link { COLOR: white; TEXT-DECORATION: none; font-weight: normal }*/
    /*a:visited { COLOR: black; TEXT-DECORATION: none; font-weight: normal }*/
    /*a:active { margin-bottom: 1%; border-bottom: solid white 1px; TEXT-DECORATION: none }*/
    /*a:hover { COLOR: black; TEXT-DECORATION: none; font-weight: none }*/
</style>
<nav class="navbar shadow-small fixed-top navbar-expand-lg navbar-dark fixed-top " style="background-color:#2C73D2;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
{{--            {{ config('app.name', 'Laravel') }}--}}
            HIMATIKA
{{--            <img src="{{asset('images/LOGO himatika 2019.png')}}" style="width: 42px ;height: 40px">--}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{--                @if (Route::has('login'))--}}
            <ul class="navbar-nav mr-auto">
                {{--                        list menu navbar kiri--}}
                <li class="nav-item {{ Route::is('allArtikel','detailArtikel') ? 'active' : null  }}">
                    <a class="nav-link " href="{{route('allArtikel')}}">Artikel</a>
                </li>
                @auth
                    @if(Auth::user()->as == "admin")

                        <li class="nav-item {{ Route::is('index_agenda','showAgenda') ? 'active' : null  }}">
                            <a href="{{ route('index_agenda') }}" class="nav-link">Agenda</a>
                        </li>
                        <li class="nav-item disabled">
                            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                        </li>

                    @elseif(Auth::user()->as == "pengurus")

                        <li class="nav-item {{ Route::is('index_agenda','showAgenda') ? 'active' : null  }}">
                            <a href="{{ route('index_agenda') }}" class="nav-link">Agenda</a>
                        </li>
                        <li class="nav-item {{ Route::is('pengurusaspirasi') ? 'active' : null  }}">
                            <a href="{{ route('pengurusaspirasi') }}" class="nav-link">Aspirasi</a>
                        </li>

                    @elseif(Auth::user()->as == "mahasiswa")
                        @if(\App\Models\pendaftaran::where('id_user',Auth::user()->id)->count()==1)
                            @if(\App\Models\pendaftaran::where('id_user',Auth::user()->id)->where('status','GAGAL')->first())
                            @else
                                <li class="nav-item {{ Route::is('tespendaftar','daftarindex') ? 'active' : null  }}">
                                    <a class="nav-link" href="{{route('tespendaftar')}}">Tes Tulis <span
                                            class="sr-only">(current)</span></a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item {{ Route::is('daftarindex') ? 'active' : null  }}">
                                <a class="nav-link" href="{{route('daftarindex')}}">Daftar <span class="sr-only">(current)</span></a>
                            </li>
                        @endif
                    <!-- Left Side Of Navbar -->
                        {{--                        list menu navbar kiri--}}
            </ul>
            @endif
            @endif
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nama_pendek }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('showProfile')}}"> <i
                                    class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile</a>
                            <a class="dropdown-item" href="{{route('indexSandi')}}"><i
                                    class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i> Ubah Password</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<main style="margin-top: 75px">
    @yield('content')
</main>
</body>
{{--<footer class="footer" style="background: #2C73D2; height: 60px;">--}}
{{--    <div class="container">--}}
{{--        <p class="m-0 text-center" style="color: #fff;">Copyright &copy; HIMATIKA 2020</p>--}}
{{--    </div>--}}
{{--    <!-- /.container -->--}}
{{--</footer>--}}
</html>
