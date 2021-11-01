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
                <li class="breadcrumb-item active">Edit Dokter</li>
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
            <form role="form" method="post" action="{{ route('dokter.update',$dokter->id) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputNama">Nama</label>
                        <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" value="{{ $dokter->nama_dokter }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="jk">
                            <option value="laki-laki" @if ($dokter->jk == 'laki-laki')
                                selected=""
                            @endif>Laki-Laki</option>
                            <option value="perempuan" @if ($dokter->jk == 'perempuan')
                                selected=""
                            @endif>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">Pendidikan Terakhir</label>
                        <input type="text" class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir" value="{{ $dokter->pendidikan_terakhir }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPoli">Poli</label>
                        <select class="form-control" name="poli_id" id="poli_id">
                            <option value="">--Pilih Poli--</option>
                            @foreach ($poli as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $dokter->poli_id)
                                    selected=""
                                @endif>{{ $item->nama }}</option>
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