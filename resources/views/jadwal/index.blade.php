@extends('layouts/main-admin')

@section('title', 'Jadwal')

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
                <li class="breadcrumb-item active">JADWAL</li>
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
                        <th>DOKTER</th>
                        <th>POLI KLINIK</th>
                        <th>HARI</th>
                        <th>JAM PRAKTIK</th>
                        @if (Auth::user()->type == 'admin')
                            <th width="80">AKSI</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwals as $jadwal)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{ $jadwal->dokter->nama_dokter }}</td>
                        <td>{{ $jadwal->dokter->poli->nama }}</td>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jam_praktik }} WIB</td>
                        @if (Auth::user()->type == 'admin')
                            <td class="text-center">
                                <a href="{{ route('jadwal.edit', $jadwal->id) }}">
                                    <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></button>
                                </a>
                                <form id="delete-user-{{$jadwal->id}}" action="/jadwal/{{$jadwal->id}}" method="post" style="display: inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@include ('includes.scripts')
@if (Auth::user()->type == 'admin')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#data-admin_length").append('<a  href="{{ route('jadwal.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
@endif
@endsection