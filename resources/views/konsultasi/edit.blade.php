@extends('layouts/main-admin')

@section('title', 'Edit Konsultasi')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">EDIT KONSULTASI</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Konsultasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('konsultasi.update', $konsultasi->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pilihlah Gejala yang Anda Rasakan!</label>
                    </div>
                    <hr>
                    @foreach ($gejalas as $key => $gejala)
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="gejala[]" id="customCheck-{{ $key }}" value="{{ $gejala->id }}" class="custom-control-input" {{ $gejala->attr }}>
                            <label class="custom-control-label" for="customCheck-{{ $key }}">{{ $gejala->gejala }} ({{ $gejala->kode }})</label>              
                        </div>
                    @endforeach
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
@section('script')
@endsection