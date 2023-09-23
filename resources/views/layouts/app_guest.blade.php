<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('') }}modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('') }}modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{asset('') }}css/style.css">
    <link rel="stylesheet" href="{{asset('') }}css/components.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
    </script>
    <style>
        .img-logo {
            width: 13%;
        }
        @media only screen and (max-width: 720px) {
            #nav-right {
                display: none
            }

            .img-logo {
                width: 30%
            }
        }
    </style>
    @stack('css')
</head>

<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
          <a href="{{url('/')}}" class="navbar-brand sidebar-gone-hide">
            <img src="{{asset('img/logo.png')}}" class="img-logo" alt="">
            {{-- <span class="mt-2">BKK SMKN Tanjung Sari</span> --}}
        </a>
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars mt-4"></i></a>
       <div class="ml-auto"></div>
        @auth
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    {{-- <img alt="image" src="{{ asset('img/avatar/alumni/' . Auth::user()->user_profile->avatar ?? 'img/avatar/avatar-1.png') }}" class="rounded-circle mr-1"> --}}
                    <div class="d-sm-none d-lg-inline-block">{{Auth::user()->name}}</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">{{Auth::user()->nisn}}</div>
                    <div class="dropdown-divider"></div>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt mt-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        @else
            <ul class="navbar-nav navbar-right" id="nav-right">
                <li class="nav-item active"><a href="mailto:smkn1tjsari@gmail.com" class="nav-link"><i class="fas fa-envelope"></i> smkn1tjsari@gmail.com</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-mobile"></i> 08127971961</a></li>
            </ul>
        @endauth
      </nav>

      <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item {{request()->is('/') ? 'active' : ''}}">
                <a href="{{url('/')}}" class="nav-link"><i class="fas fa-home"></i><span>Beranda</span></a>
            </li>
            <li class="nav-item {{request()->is('lokers*') ? 'active' : ''}}">
                <a href="{{url('/lokers')}}" class="nav-link"><i class="fas fa-newspaper"></i><span>Lowongan Pekerjaan</span></a>
            </li>
            @auth
                @if (Auth::check() && isset(Auth::user()->user_profile))
                    <li class="nav-item {{request()->is('profile') ? 'active' : ''}}">
                        <a href="{{url('/profile')}}" class="nav-link"><i class="fas fa-user"></i><span>Profile</span></a>
                    </li>
                @endif
            @endauth
            @if (!Auth::check())
                <li class="nav-item">
                    <a href="{{url('/register')}}" class="nav-link"><i class="fas fa-sign-in-alt"></i><span>Pendaftaran</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/login')}}" class="nav-link"><i class="fas fa-user"></i><span>Login</span></a>
                </li>
            @endif
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <marquee behavior="500" direction="500">
                <h1 class="">
                    Selamat Datang Di sistem informasi BKK SMK Negri Tanjung Sari
                </h1>
            </marquee>
          </div>

          <div class="section-body">
            @yield('content')
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; SMK Negri TANJUNG SARI {{date('Y')}}
        </div>
        <div class="footer-right">

        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('') }}modules/jquery.min.js"></script>
  <script src="{{asset('') }}modules/popper.js"></script>
  <script src="{{asset('') }}modules/tooltip.js"></script>
  <script src="{{asset('') }}modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{asset('') }}modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{asset('') }}modules/moment.min.js"></script>
  <script src="{{asset('') }}js/stisla.js"></script>
  <script src="{{asset('') }}js/scripts.js"></script>
  <script src="{{asset('') }}js/custom.js"></script>
  @stack('js')
</body>
</html>
