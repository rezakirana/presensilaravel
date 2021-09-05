@extends('layouts/main-admin')

@section('title', 'Konsultasi')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">KONSULTASI</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Konsultasi</li>
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
                        <th>PERIODE KONSULTASI</th>
                        <th>TANGGAL KONSULTASI</th>
                        <th>HASIL DIAGNOSA</th>
                        <th width="120">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($konsultasi as $konsul)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>Periode ke-{{ $konsul->periode }}</td>
                        <td>{{ $konsul->created_at }}</td>
                        <td>{{ $konsult->dianogsa }}</td>
                        <td class="text-center">
                            <a href="{{ route('konsultasi.show', $konsul->id) }}">
                                <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat"><i class="fa fa-eye"></i></button>
                            </a>
                            <a href="{{ route('konsultasi.edit', $konsul->id) }}">
                                <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></button>
                            </a>
                            <form id="delete-konsultasi-{{$konsul->id}}" action="/konsultasi/{{$konsul->id}}" method="post" style="display: inline;">
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
            $("#data-admin_length").append('<a  href="{{ route('konsultasi.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Konsultasi Lagi</button></a>');
        });
    </script>
@endsection