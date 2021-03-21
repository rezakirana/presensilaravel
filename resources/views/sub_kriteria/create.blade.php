@extends('layouts/main-admin')

@section('title', 'Dashboard Admin')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">TAMBAH KRITERIA <span class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Ubah">{{$data->nama}}</span></h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah Sub Kriteria</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('sub-kriteria.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Kriteria</label>
                        <input type="text" class="form-control" name="kriteria" id="exampleInputPassword1" value="{{ $data->nama }}" disabled>
                        <input type="hidden" name="id_kriteria" value="{{ $data->id }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Sub Kriteria</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputPassword1" placeholder="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="exampleInputPassword1" placeholder="keterangan" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bobot</label>
                        <input type="number" class="form-control" name="bobot" id="exampleInputPassword1" placeholder="bobot" required>
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