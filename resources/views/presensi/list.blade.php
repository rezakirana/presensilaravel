@extends('layouts/main-admin')

@section('title', 'List Presensi')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">LIST PRESENSI</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">List Presensi</li>
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
                <div class="col-md-6">
                    <h5>{{ $jadwal->mapel->nama_mapel }}</b></h5>
                    <h5>Guru Pengampu : <b>{{ $jadwal->guru->nama }}</b></h5>
                    <h5>Kelas : <b>{{ $jadwal->kelas->nama_kelas }}</b></h5>
                </div>
                <div class="col-md-6" style="text-align:right;">
                    <h6>Tahun Ajaran : <b>{{ $jadwal->tahun_ajaran->tahun_ajaran }} ({{ $jadwal->semester->semester }})</b></h6>    
                    <h6><b>{{ ucwords($jadwal->hari) }}, {{ $jadwal->jam_pelajaran }}</b></h6>                        
                </div>
            </div>              
            <hr>
            <br>
            <table id="data-admin" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th width="40">NO</th>
                    <th>PERTEMUAN</th>
                    <th>MATERI PERTEMUAN</th>
                    <th>TANGGAL</th>
                    <th width="120">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($presensi as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{ $item->pertemuan }}</td>
                        <td>{{ $item->materi_pertemuan }}</td>
                        <td>{{ $item->tanggal->isoFormat('D MMMM Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('presensi.detail', $item->id) }}">
                                <button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></button>
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
    @if (auth()->user()->type == 'guru')
        @if (count($presensi))
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#data-admin_length").append('<a  href="{{ route('tambah.presensi',$jadwal->id) }}"> <button type="button" class="btn btn-outline-primary ml-3">Presensi baru</button></a>');
                    $("#data-admin_length").append('<a  href="{{ route('export.semua',$jadwal->id) }}"> <button type="button" class="btn btn-outline-info ml-3"><i class="fa fa-print"></i> Export</button></a>');
                    $("#data-admin_length").append('<a  href="{{ route('cetak.semua',$jadwal->id) }}"> <button type="button" class="btn btn-outline-info ml-3"><i class="fa fa-print"></i> Cetak</button></a>');
                });
            </script>
        @else
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#data-admin_length").append('<a  href="{{ route('tambah.presensi',$jadwal->id) }}"> <button type="button" class="btn btn-outline-primary ml-3">Presensi baru</button></a>');                
                });
            </script>
        @endif 
    @else
        @if (count($presensi))
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#data-admin_length").append('<a  href="{{ route('export.semua',$jadwal->id) }}"> <button type="button" class="btn btn-outline-info ml-3"><i class="fa fa-print"></i> Export</button></a>');
                    $("#data-admin_length").append('<a  href="{{ route('cetak.semua',$jadwal->id) }}"> <button type="button" class="btn btn-outline-info ml-3"><i class="fa fa-print"></i> Cetak</button></a>');
                });
            </script>
        @endif 
    @endif       
@endsection