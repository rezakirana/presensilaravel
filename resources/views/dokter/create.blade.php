@extends('layouts/main-admin')

@section('title', 'Dashboard Admin')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">Manajemen Dokter</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah Dokter</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <h3>Profil Account</h3>
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('dokter.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputJK">User</label>
                        <select class="form-control" name="user_id" id="user_id" required>
                            <option value="">--Pilih User--</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">Nama</label>
                        <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="jk">
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">Pendidikan Terakhir</label>
                        <input type="text" class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir" placeholder="Pendidikan Terakhir" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPoli">Poli</label>
                        <select class="form-control" name="poli_id" id="poli_id">
                            <option value="">--Pilih Poli--</option>
                            @foreach ($poli as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection