@extends('layouts/main-admin')

@section('title', 'Dashboard Admin')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">Manajemen Account</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Change Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>

@if (Auth::user()->type == 'admin')
    <section class="container-fluid">
        <div class="card">
            @include ('includes.flash')
            <div class="card-body">
                <form role="form" method="post" action="{{ route('account.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Current Password</label>
                            <input type="password" class="form-control" name="currentPassword" id="exampleInputPassword1" placeholder="Current Password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="New Password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password Confirmation</label>
                            <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword1" placeholder="Password Confirmation" required>
                        </div>
                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@elseif (Auth::user()->type == 'dokter')
<section class="container-fluid">
    <h3>Credentials Account</h3>
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('account.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Current Password</label>
                        <input type="password" class="form-control" name="currentPassword" id="exampleInputPassword1" placeholder="Current Password" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="New Password" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword1" placeholder="Password Confirmation" required>
                    </div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
<hr>
<section class="container-fluid">
    <h3>Profil Account</h3>
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('accountProfile.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputNama">Nama</label>
                        <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" value="{{ Auth::user()->dokter->nama_dokter }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="jk">
                            <option value="laki-laki" @if (Auth::user()->dokter->jk == 'laki-laki')
                                selected=""
                            @endif>Laki-Laki</option>
                            <option value="perempuan" @if (Auth::user()->dokter->jk == 'perempuan')
                                selected=""
                            @endif>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">Pendidikan Terakhir</label>
                        <input type="text" class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir" value="{{ Auth::user()->dokter->pendidikan_terakhir }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPoli">Poli</label>
                        <input type="text" class="form-control" name="poli" id="poli" value="{{ Auth::user()->dokter->poli->nama }}" readonly>
                    </div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@else
<section class="container-fluid">
    <h3>Credentials Account</h3>
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('account.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Current Password</label>
                        <input type="password" class="form-control" name="currentPassword" id="exampleInputPassword1" placeholder="Current Password" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="New Password" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword1" placeholder="Password Confirmation" required>
                    </div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
<hr>
<section class="container-fluid">
    <h3>Profil Account</h3>
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('accountProfile.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputNama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ Auth::user()->pasien->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="jk">
                            <option value="laki-laki" @if (Auth::user()->pasien->jk == 'laki-laki')
                                selected=""
                            @endif>Laki-Laki</option>
                            <option value="perempuan" @if (Auth::user()->pasien->jk == 'perempuan')
                                selected=""
                            @endif>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik" value="{{ Auth::user()->pasien->nik }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">TTL</label>
                        <div class="input-group date col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control pull-right" id="datepicker" name="ttl" value="{{ $ttl }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPoli">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control">{{ Auth::user()->pasien->alamat }}</textarea>
                    </div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endif
@include ('includes.scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function () {
        //Date picker
        $('#datepicker').datepicker({
        autoclose: true
        })
    });
</script>
@endsection