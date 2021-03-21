@extends('layouts/main-admin')

@section('title', 'Edit Sub Kriteria')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">EDIT SUB KRITERIA</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Sub Kriteria</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('sub-kriteria.update', $data->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Sub Kriteria</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputPassword1" placeholder="nama" value="{{ $data->nama }}" required>
                        <input type="hidden" name="id_kriteria" value="{{ $data->id_kriteria }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="exampleInputPassword1" placeholder="keterangan" value="{{ $data->keterangan }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bobot</label>
                        <input type="number" class="form-control" name="bobot" id="exampleInputPassword1" placeholder="bobot" value="{{ $data->bobot }}" required>
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