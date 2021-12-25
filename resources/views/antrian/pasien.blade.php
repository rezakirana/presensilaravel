@extends('layouts/main-admin')

@section('title', 'Pasien')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">DATA ANTRIAN</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">DATA ANTRIAN</li>
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
                        <th>POLI</th>
                        <th>DOKTER</th>
                        <th>HARI</th>
                        <th>TANGGAL DAFTAR</th>
                        <th>JAM DAFTAR</th>
                        <th>NO ANTRIAN</th>
                        <th width="80">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{ $item->namaPoli }}</td>
                        <td>{{ $item->nama_dokter }}</td>
                        <td>{{ $item->hari }}</td>
                        <td>{{  date('d F Y', strtotime($item->tanggal_daftar)) }}</td>
                        <td>{{ $item->jam_daftar }}</td>
                        <td>{{ $item->kodePoli }} {{ $item->no_antrian }}</td>
                        <td class="text-center">
                            <a href="{{ route('download.antrian', $item->id) }}">
                                <button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ubah"> download</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection