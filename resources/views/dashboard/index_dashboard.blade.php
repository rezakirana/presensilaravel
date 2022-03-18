@extends('layouts/main-admin')

@section('title', 'Dashboard Admin')

@section('container')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halo, {{ auth()->user()->type == 'admin' ? 'Admin' : 'Guru' }}</h1>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-4 mb-4">
            <a href="{{ route('poli.index') }}" style="text-decoration:none;">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Item 1</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
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
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Item 2</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Item 3</div>
                            <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">10</div>
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
@endsection