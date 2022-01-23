@extends('layouts/main-auth')

@section('title', 'Register - Sistem Antrian Puskesmas')

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
                  <h5 class="header-title" style="text-align: center;margin-bottom:10px;padding-bottom:10px;">Sistem Antrian Puskesmas</h5>
                  <form class="user" method="POST" action="{{ route('store.pasien') }}">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputPendidikanTerakhir">NIK</label>
                      <input id="nik" type="number" class="form-control form-control-user @error('nik') is-invalid @enderror" name="nik" id="nikValidation" value="{{ old('nik') }}" placeholder="NIK anda" required autocomplete="nik" autofocus style="-webkit-appearance: none;margin: 0;">
                      @error('nik')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPendidikanTerakhir">Nama</label>
                      <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nama anda" required autocomplete="name" autofocus>
                        @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">Tanggal Lahir</label>
                        <div class="input-group date col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control pull-right" id="datepicker" name="ttl" required>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPendidikanTerakhir">Jenis Kelamin</label>
                      <select name="jk" id="jk" class="form-control" required>
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                        @error('jk')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPendidikanTerakhir">Alamat</label>
                      <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" required placeholder="alamat"></textarea>
                        @error('alamat')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPendidikanTerakhir">Username</label>
                      <input id="username" type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" value="{{ old('email') }}" placeholder="Email address" required autocomplete="username" autofocus>
                      @error('username')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">Password</label>
                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="New Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group" style="margin-top:-7px">
                        <div class="custom-control custom-checkbox small">
                          <label style="float:right;">
                              @if (Route::has('login'))
                                  <a href="{{ route('login') }}">Sudah punya akun ?Masuk!</a>
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
                    <span class="small">Copyright &copy; Sistem Antrian Puskesmas 2021</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include ('includes.scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
      $(function () {
          $('#datepicker').datepicker({
          autoclose: true
          })
      });
      $('#nikValidation').on('keyup', function () {
        this.value = this.value.replace(/[^0-9]/gi, '')
      });
  </script>
  @endsection