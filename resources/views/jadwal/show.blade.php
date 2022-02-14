@extends('layouts/main-admin')

@section('title', 'Detail Jadwal')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">JADWAL</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Detail Jadwal</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>TAHUN AJARAN</td>
                        <td>: {{ $jadwal->tahun_ajaran->tahun_ajaran }} ({{ $jadwal->semester->semester }})</td>
                    </tr>
                    <tr>
                        <td>KELAS</td>
                        <td>: {{ $jadwal->kelas->nama_kelas }}</td>
                    </tr>
                    <tr>
                        <td>GURU PENGAMPU</td>
                        <td>: {{ $jadwal->guru->nama }}</td>
                    </tr>
                    <tr>
                        <td>MATA PELAJARAN</td>
                        <td>: {{ $jadwal->mapel->nama_mapel }}</td>
                    </tr>
                    <tr>
                        <td>HARI</td>
                        <td>: {{ ucwords($jadwal->hari) }}</td>
                    </tr>
                    <tr>
                        <td>JAM PELAJARAN</td>
                        <td>: {{ $jadwal->jam_pelajaran }}</td>
                    </tr>                    
                </table>   
                <hr>
                <h4>Data Siswa</h4>     
                <table class="table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIS</th>
                            <th>NAMA</th>
                            <th>JENIS KELAMIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal->kelas->siswas as $key => $item)
                            <tr>
                                <td>{{ ($key+1) }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->gender }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection