@extends('layouts/main-admin')

@section('title', 'Semester')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">SEMESTER</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Semester</li>
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
                    <th>SEMESTER</th>
                    <th>STATUS</th>
                    <th width="120">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($semester as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{ $item->semester }}</td>                        
                            @if ($item->status == '1')
                                <td>
                                    <i class="fas fa-check-circle" style="color: green;"></i> Aktif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('semester.change', $item->id) }}">
                                        <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Non Aktifkan"><i class="fa fa-power-off"></i></button>
                                    </a>
                                </td>    
                            @else
                                <td>
                                    <i class="fas fa-times-circle" style="color: red;"></i> Tidak Aktif                                
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('semester.change', $item->id) }}">
                                        <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-power-off"></i></button>
                                    </a>
                                </td> 
                            @endif
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