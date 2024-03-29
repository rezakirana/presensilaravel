@extends('layouts/main-admin')

@section('title', 'Tambah Kelas')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">KELAS</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah Kelas</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        {{--
            @include ('includes.flash')
        --}}
        <div class="card-body">
            <form role="form" method="post" action="{{ route('kelas.store') }}">
                @csrf                
                <div class="form-group">
                    <label for="exampleInputPassword1">Kode Kelas</label>
                    <input type="text" class="form-control" name="kode_kelas" id="kode_kelas" placeholder="Kode Kelas" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama Kelas</label>
                    <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" required>
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