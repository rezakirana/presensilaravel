<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <!-- Font Awesome -->
  <script defer src="{{ asset('js/all.js') }}"></script>
  
  <!-- Bootstrap & Custom CSS -->
  <link href="{{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <!-- Animate CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <!-- Icon -->
  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
  {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> --}}
</head>

<body class="bg-gradient-primary">
  {{-- @include('sweetalert::alert') --}}
  @yield('container')
  
  <!-- Bootstrap core JavaScript-->
  <script defer src="{{ asset('js/jquery.min.js') }}"></script>
  <script defer src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script defer src="{{ asset('js/bootstrap.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script defer src="{{ asset('js/jquery.easing.min.js') }}"></script>
</body>

</html>