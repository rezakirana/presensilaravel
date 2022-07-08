@extends('layouts/main-admin')

@section('title', 'Edit Mapel')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">MAPEL</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Mapel</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('mapel.update', $mapel->id) }}">
                <input type="hidden" name="id" value="{{ $mapel->id }}" />
                @csrf      
                @method('put')          
                <div class="form-group">
                    <label for="exampleInputPassword1">Kode Mapel</label>
                    <input type="text" class="form-control" name="kode_mapel" id="kode_mapel" value="{{ $mapel->kode_mapel }}" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama Mapel</label>
                    <input type="text" class="form-control" name="nama_mapel" id="nama_mapel" value="{{ $mapel->nama_mapel }}" required>
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