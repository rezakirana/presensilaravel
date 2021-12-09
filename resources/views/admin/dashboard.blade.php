@extends('layouts/main-admin')

@section('title', 'Dashboard Admin')

@section('container')
    @if ($user->type == "admin")
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-4 mb-4">
                    <a href="{{ route('poli.index') }}" style="text-decoration:none;">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Poli</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $poli }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 mb-4">
                    <a href="{{ route('dokter.index') }}" style="text-decoration:none;">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Jumlah Dokter</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dokter }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-stethoscope fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 mb-4">
                    <a href="{{ route('pasien.index') }}" style="text-decoration:none;">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pasien</div>
                                    <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $pasien }}</div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-users fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @elseif($user->type == 'dokter')
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard Dokter</h1>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-4 mb-4">
                    <a href="{{ route('poli.index') }}" style="text-decoration:none;">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Poli</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $poli }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 mb-4">
                    <a href="{{ route('pasien.index') }}" style="text-decoration:none;">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pasien</div>
                                    <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $pasien }}</div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-users fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard Pasien</h1>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-4 mb-4">
                    <a href="{{ route('poli.index') }}" style="text-decoration:none;">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Poli</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $poli }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 mb-4">
                    <a href="{{ route('dokter.index') }}" style="text-decoration:none;">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Jumlah Dokter</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dokter }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-stethoscope fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection