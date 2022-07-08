@extends('layouts/main-auth')

@section('title', 'Login - Sistem Informasi Akademi')

@section('container')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row align-items-center">
              <div class="col-lg-6 d-none d-lg-block" style="padding-left: 50px;">
                <div class="text-center">
                  <br>
                    <h1 class="h2 text-gray-900 mb-4 font-weight-bold animate__animated animate__fadeInDown animate__delay-1s">Login Presensi</h1>
                  </div>
                <img src="img/immigration.png" class="bg-login-image animate__animated animate__backInLeft" alt="">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  @if(Session::has('message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ Session::get('message') }}
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                  @endif
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                          <ul>
                              <li>{{ $error }}</li>
                          </ul>
                      @endforeach
                  </div>
                  @endif
                  @if ($message = Session::get('danger'))
                    <div class="alert alert-danger">{{$message }}</div>
                  @endif
                  <h5 class="header-title" style="text-align: center;margin-bottom:10px;padding-bottom:10px;">Login Panel</h5>
                  <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                    <input id="username" type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Enter Username" required autocomplete="username" autofocus>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                    <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Ingat Saya</label>                    
                        <label for="">
                             &nbsp;
                        </label>                        
                      </div>
                    </div>
                    <button class="btn btn-success btn-user btn-block" type="submit">
                      Login
                    </button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <span class="small">Copyright &copy; Sistem Presensi MA 2022</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection