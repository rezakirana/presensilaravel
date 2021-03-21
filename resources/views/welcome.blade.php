<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SPK Wisata</title>

        <!-- Font Awesome -->
        <script defer src="{{ asset('js/all.js') }}"></script>
        
        <!-- Bootstrap & Custom CSS -->
        <link href="{{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/landingStyle.css') }}" rel="stylesheet">

        <!-- Icon -->
        <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>

        <!-- Animate CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    </head>
    <body>
        <img src="img/wafe.png" alt="" class="wave">
        <!-- Navbar -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <nav class="navbar navbar-expand-md navbar-light bg-light oswaldregular">
                        <a class="navbar-brand animate__animated animate__slideInLeft" href="#">
                            <h1 class="header-title">SPK WISATA</h1>
                        </a>
                        {{-- @include('sweetalert::alert') --}}
                        @if (Route::has('login'))
                        <ul class="navbar-nav ml-auto text-center text-uppercase">
                            @auth
                            <li class="nav-item animate__animated animate__slideInRight">
                                <a class="nav-link" href="{{ url('/home') }}">Dashboard <i class="fas fa-home"></i></a>
                            </li>
                            @else
                            <li class="nav-item animate__animated animate__slideInRight">
                                <a class="nav-link" href="{{ route('login') }}">Login <i class="fas fa-arrow-circle-right"></i></a>
                            </li>
                            @endauth
                        </ul>
                        @endif
                    </nav>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="container m-container">
            <div class="row align-items-center">
                <div class="col-md-6 animate__animated animate__slideInLeft">
                    <h1 class="header-title">Management Vacation</h1>
                    <p class="header-text">Manage your vacation with just one application</p>
                </div>
                <div class="col-md-6 animate__animated animate__fadeIn">
                    <img src="img/landing.png" alt="" class="header-img">
                </div>
            </div>
        </div>

        <!-- Bootstrap JavaScript-->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    </body>
</html>
