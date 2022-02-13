@extends('layouts/main-admin')

@section('title', 'Edit Tahun Ajaran')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">TAHUN AJARAN</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Tahun Ajaran</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('tahun-ajaran.update',$data->id) }}">
                @csrf                
                @method('put')
                <div class="form-group">
                    <label for="exampleInputPassword1">Tahun Ajaran</label>
                    <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" value="{{ $data->tahun_ajaran }}" required>
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