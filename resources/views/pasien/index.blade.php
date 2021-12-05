@extends('layouts/main-admin')

@section('title', 'Pasien')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">PASIEN</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">PASIEN</li>
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
                        <th>USERNAME</th>
                        <th>NAMA</th>
                        <th>NIK</th>
                        <th>JENIS KELAMIN</th>
                        <th>TANGGAL LAHIR</th>
                        <th>ALAMAT</th>
                        @if (Auth::user()->type == 'admin')
                            <th width="80">AKSI</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($pasiens as $pasien)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{ $pasien->username }}</td>
                        <td>{{ $pasien->nama }}</td>
                        <td>{{ $pasien->nik }}</td>
                        <td>{{ ucwords($pasien->jk) }}</td>
                        <td>{{  date('d F Y', strtotime($pasien->ttl)) }}</td>
                        <td>{{ $pasien->alamat }}</td>
                        @if (Auth::user()->type == 'admin')
                            <td class="text-center">
                                <a href="{{ route('pasien.edit', $pasien->id) }}">
                                    <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></button>
                                </a>
                                <form id="delete-user-{{$pasien->id}}" action="/pasien/{{$pasien->id}}" method="post" style="display: inline;">
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
            $("#data-admin_length").append('<a  href="{{ route('pasien.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
@endif
@endsection