@extends('layouts/main-admin')

@section('title', 'Dashboard Admin')

@section('container')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halo, {{ auth()->user()->type == 'admin' ? 'Admin' : 'Guru' }}</h1>
    </div>
    <div class="row">
        @if (auth()->user()->type == 'admin')
            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('guru.index') }}" style="text-decoration:none;">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Guru</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jmlGuru }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-users fa-2x text-gray-300"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('kelas.index') }}" style="text-decoration:none;">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jmlKelas }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-landmark fa-2x text-gray-300"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('siswa.index') }}" style="text-decoration:none;">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jmlSiswa }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('mapel.index') }}" style="text-decoration:none;">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Mata Pelajaran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jmlMapel }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('jadwal.index') }}" style="text-decoration:none;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Jadwal Aktif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jmlJadwal }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @else            
            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('kelas.index') }}" style="text-decoration:none;">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jmlKelas }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-landmark fa-2x text-gray-300"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>                        
            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('presensi.data') }}" style="text-decoration:none;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Jadwal Aktif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jmlJadwal }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif        
    </div>
</div>
@endsection