@extends('layouts/main-admin')

@section('title', 'Presensi')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">PRESENSI</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Presensi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        <div class="card-body">
            <table id="data-admin" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th width="40">NO</th>
                    <th>Tanggal</th>
                    <th>Kelas</th>
                    <th>Mapel</th>
                    <th width="80">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                
                   @foreach ($dataPresensi as $key => $presensi)
                   <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $presensi->tanggal }}</td>
                        <td>{{ $presensi->kelas->nama_kelas }}</td>
                        <td>{{ $presensi->mapel->nama_mapel }}</td>
                        <td class="text-center">
                            <a href="{{ route('presensi.show', $presensi->id)}}">
                                <button class="btn btn-primary btn-sm" data-toogle="tooltip" data-placement="top" title="Detail">
                                    Detail
                                </button>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#data-admin_length").append('<a href="{{ route("presensi.create") }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
@endsection