@extends('layouts/main-auth')

@section('title', 'Register - Expert System')

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
                <img src="img/deliveries.svg" class="bg-login-image animate__animated animate__backInLeft" alt="">
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
                  <h5 class="header-title" style="text-align: center;margin-bottom:10px;padding-bottom:10px;">SPK WISATA</h5>
                  <form class="user" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full name" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    <div class="form-group">
                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="New Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password_confirmation" type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation" placeholder="Retype Password">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <label style="float:right;">
                            @if (Route::has('password.update'))
                                <a href="{{ route('password.update') }}">Forgot Password?</a>
                            @endif
                        </label>
                      </div>
                    </div>
                    <div class="form-group" style="margin-top:-7px">
                        <div class="custom-control custom-checkbox small">
                          <label style="float:right;">
                              @if (Route::has('login'))
                                  <a href="{{ route('login') }}">Already have an account ?Login!</a>
                              @endif
                          </label>
                        </div>
                      </div>
                    <button class="btn btn-primary btn-user btn-block" type="submit">
                      Register
                    </button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <span class="small">Copyright &copy; SPK Wisata 2021</span>
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