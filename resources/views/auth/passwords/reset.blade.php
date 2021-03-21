@extends('layouts/main-auth')

@section('title', 'Reset Password')

@section('container')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row align-items-center">
              <div class="col-lg-6 d-none d-lg-block">
                <img src="{{ asset('img/reset_password.svg') }}" class="bg-password-image animate__animated animate__fadeInDown" alt="">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    @if(Session::has('status'))
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ Session::get('status') }}
                          <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">×</span>
                          </button>
                      </div>
                    @endif
                    <h1 class="h4 text-gray-900 mb-2">Set a New Password!</h1>
                    <p class="mb-4">Enter password and repeat password for create a new password for your account</p>
                  </div>
                  <form class="user" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token_password" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}" required>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password" autofocus>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control form-control-user" placeholder="Repeat Password" name="password_confirmation" required autocomplete="new-password">
                      </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Set New Password
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection