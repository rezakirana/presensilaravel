@extends('layouts/main-admin')

@section('title', 'Dashboard Admin')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">KRITERIA</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Ubah Kriteria</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('kriteria.update', $data->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Kriteria</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputPassword1" value="{{ $data->nama }}" placeholder="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Kriteria</label>
                        <select name="jenis" id="jenis" class="form-control" required>
                            <option value="benefit" @if ($data->jenis == 'benefit')
                                selected=""
                            @endif>Benefit</option>
                            <option value="cost" @if ($data->jenis == 'cost')
                                selected=""
                            @endif>Cost</option>
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