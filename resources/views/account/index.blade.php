@extends('layouts/main-admin')

@section('title', 'Guru')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">GURU</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Guru</li>
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
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>JENIS KELAMIN</th>
                    <th>TTL</th>
                    <th width="120">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $guru)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{ $guru->nip }}</td>
                        <td>{{ $guru->nama }}</td>
                        <td>{{ $guru->gender }}</td>
                        <td>{{ $guru->tempat_lahir }}, {{ $guru->tgl_lahir->isoFormat('D MMMM Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('guru.show', $guru->id) }}">
                                <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></button>
                            </a>
                            <a href="{{ route('guru.edit', $guru->id) }}">
                                <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></button>
                            </a>
                            <form id="delete-user-{{$guru->id}}" action="/guru/{{$guru->id}}" method="post" style="display: inline;">
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
            $("#data-admin_length").append('<a  href="{{ route('guru.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
@endsection