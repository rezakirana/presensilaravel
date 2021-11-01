@extends('layouts/main-admin')

@section('title', 'Dokter')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">DOKTER</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">DOKTER</li>
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
                    <th>JENIS KELAMIN</th>
                    <th>PENDIDIKAN TERAKHIR</th>
                    <th>POLI</th>
                    <th width="80">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokter as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{ $item->user->username }}</td>
                        <td>{{ $item->nama_dokter }}</td>
                        <td>{{ ucwords($item->jk) }}</td>
                        <td>{{ $item->pendidikan_terakhir }}</td>
                        <td>{{ $item->poli->nama }}</td>
                        <td class="text-center">
                            <a href="{{ route('dokter.edit', $item->id) }}">
                                <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></button>
                            </a>
                            <form id="delete-user-{{$item->id}}" action="/dokter/{{$item->id}}" method="post" style="display: inline;">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                            </form>
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
            $("#data-admin_length").append('<a  href="{{ route('dokter.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
@endsection