@extends('layouts/main-admin')

@section('title', 'Penyakit')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">PENYAKIT</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Penyakit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    @if ($penyakit)
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 30%;"><b>Kode Penyakit</b></td>
                                    <td style="width: 70%;">{{$penyakit->kode}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Nama Penyakit</b></td>
                                    <td style="width: 70%;">{{$penyakit->penyakit}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Nilai Probabilitas</b></td>
                                    <td style="width: 70%;">{{$penyakit->probabilitas}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Image</b></td>
                                    <td style="width: 70%;">
                                        @if ($penyakit->image)
                                            <img src="{{ asset('/img/penyakit/'.$penyakit->image) }}" width="200px" height="200px" style="text-align: center;" alt="{{ $penyakit->penyakit }}" />
                                        @else
                                        <img src="{{ asset('/img/default-image.png') }}" width="200px" height="200px" style="text-align: center;" alt="{{ $penyakit->penyakit }}" />
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Keterangan Penyakit</b></td>
                                    <td style="width: 70%;">{!! $penyakit->keterangan !!}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Penanganan Penyakit</b></td>
                                    <td style="width: 70%;">{!! $penyakit->penanganan !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection