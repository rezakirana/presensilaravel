@extends('layouts/main-admin')

@section('title', 'List Presensi')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">LIST REKAP PRESENSI</h2>
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
            <h3>DATA JUMLAH STATUS KEHADIRAN SISWA</h3>
            <table id="data-admin" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th width="40">NO</th>
                    <th>NIS</th>
                    <th>NAMA SISWA</th>
                    <th>HADIR</th>
                    <th>IZIN</th>
                    <th>SAKIT</th>
                    <th>ALPHA</th>                    
                    </tr>
                </thead>
                <tbody>                     
                    @foreach($getNamaSiswa as $key => $item)                                     
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{ $item['nis'] }}</td>                            
                            <td>{{ $item['nama'] }}</td>                            
                            <td>{{ $item['hadir'] }} kali</td>                            
                            <td>{{ $item['izin'] }} kali</td>                            
                            <td>{{ $item['sakit'] }} kali</td>                            
                            <td>{{ $item['alpha'] }} kali</td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <a href="{{ route('list.presensi',$jadwal->id) }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</section>
@include ('includes.scripts') 
@endsection