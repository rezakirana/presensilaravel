@extends('layouts/main-admin')
@section('title', 'Antrian')
@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">ANTRIAN {{ $besok }}</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">ANTRIAN {{ $besok }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <table id="data-admin" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="40">NO</th>
                        <th>PASIEN</th>
                        <th>JAM DAFTAR</th>
                        <th>NO ANTRIAN</th>
                        <th>POLI</th>
                        <th>DOKTER</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jam_daftar }}</td>
                        <td>{{ $poli->kode }}{{ $item->no_antrian }}</td>
                        <td>{{ $poli->nama }}</td>
                        <td>{{ $item->nama_dokter }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection