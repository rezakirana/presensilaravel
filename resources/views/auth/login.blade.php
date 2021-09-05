@extends('layouts/main-auth')

@section('title', 'Login - Expert System')

@section('container')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row align-items-center">
              <div class="col-lg-6 d-none d-lg-block" style="padding-left: 50px;">
                <div class="text-center">
                    <h1 class="h2 text-gray-900 mb-4 font-weight-bold animate__animated animate__fadeInDown animate__delay-1s">Welcome Back!</h1>
                  </div>
                <img src="img/landing.svg" class="bg-login-image animate__animated animate__backInLeft" alt="">
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
                  <h5 class="header-title" style="text-align: center;margin-bottom:10px;padding-bottom:10px;">EXPERT SYSTEM</h5>
                  <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required autocomplete="email" autofocus>
                    @error('email')
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
                        <label class="custom-control-label" for="remember">Remember Me</label>
                        <label style="float:right;">
                            @if (Route::has('password.update'))
                                <a href="{{ route('password.update') }}">Forgot Password?</a>
                            @endif
                        </label>
                        <label for="">
                             &nbsp;
                        </label>
                        <label style="float:right;">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Don't have an account ?</a>
                            @endif
                        </label>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" type="submit">
                      Login
                    </button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <span class="small">Copyright &copy; Expert System 2021</span>
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