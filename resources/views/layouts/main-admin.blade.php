
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
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap4.css">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

   <!-- Icon -->
   <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
   <script src="/vendor/jquery/jquery.min.js"></script>
   <!-- Animate CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

</head>

<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
          <div class="sidebar-brand-icon">
              <img src="{{ asset('img/icon-logo.png') }}" alt="" width="50">
          </div>
          <div class="sidebar-brand-text mx-2">Expert System</div>
      </a>

      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ \Str::is('dashboard.*', Route::currentRouteName()) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>&nbsp; Dashboard</span>
        </a>
      </li>

      <!-- Nav Item - Manajemen Account -->
      <li class="nav-item  {{ \Str::is('account.*', Route::currentRouteName()) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('account.index') }}">
          <i class="far fa-user"></i>
          <span>&nbsp; Manajemen Account</span>
        </a>
      </li>    

      <!-- Nav Item - Manajemen User -->
      @if (Auth::user()->role->role == 'admin')
        <li class="nav-item  {{ \Str::is('users.*', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('users.index') }}">
          <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fa fa-users"></i>
            <span>&nbsp; Users</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKriteria" aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas fa-tasks"></i>
              <span>&nbsp; Master Data <i class="fas fa-angle-right" 
              style="margin-top: 5px;
              width: 1rem;
              text-align: center;
              float: right;
              vertical-align: 0;
              border: 0;
              font-weight: 900;"></i>
              </span>
          <div id="collapseKriteria" class="collapse {{ \Str::is('gejala.*', Route::currentRouteName()) ? 'show' : '' }} {{ \Str::is('penyakit.*', Route::currentRouteName()) ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Manajemen Data :</h6>
              <a class="collapse-item {{ \Str::is('gejala.*', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('gejala.index') }}">Gejala</a>
              <a class="collapse-item {{ \Str::is('penyakit.*', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('penyakit.index') }}">Penyakit</a>
              </div>
          </div>
        </li>
      @endif
      @if (Auth::user()->role->role == 'admin' || Auth::user()->role->role == 'pakar')
        <li class="nav-item  {{ \Str::is('rules.*', Route::currentRouteName()) ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('rules.index') }}">
            <i class="far fa-user"></i>
            <span>&nbsp; Manajemen Rules</span>
          </a>
        </li> 
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{ route('konsultasi.index') }}">
          <i class="fa fa-user-check"></i>
          <span>&nbsp; Konsultasi Penyakit</span>
        </a>
      </li>
    </ul>
    <!-- Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle -->
          <div class="text-center d-md-inline d-sm-none">
            <button class="btn btn-light" id="sidebarToggle"><i class="fas fa-bars"></i></button>
          </div>

          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('img/avatar.jpg') }}">
                <div style="padding-left:0.5rem;"><i class="fas fa-angle-down"></i></div>
              </a>
              <!-- Dropdown - User -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>

          </ul>

        </nav>
        <!-- Navbar -->

        <!-- Page Content -->
        {{-- @include('sweetalert::alert') --}}
        @yield('container')
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Sistem Pakar 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap JavaScript-->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('js/jquery.easing.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('js/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

  {{-- <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script> --}}

  <!-- Js Mask -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="/js/sb-admin-2.min.js"></script>
  @yield('script')

</body>

</html>
