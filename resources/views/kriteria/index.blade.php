@extends('layouts/main-admin')

@section('title', 'Kriteria')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">KRITERIA</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Kriteria</li>
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
                    <th>NAMA</th>
                    <th>JENIS</th>
                    <th width="240">SUB KRITERIA</th>
                    <th width="80">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $krit)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$krit->nama}}</td>
                        <td>{{$krit->jenis}}</td>
                        <td>
                            <a href="/sub-kriteria/{{$krit->id}}">
                            <span class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Ubah">Lihat Sub Kriteria</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="/kriteria/{{$krit->id}}/edit">
                            <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></button>
                            </a>
                            <form id="delete-kriteria-{{$krit->id}}" action="/kriteria/{{$krit->id}}" method="post" style="display: inline;">
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
    $("#data-admin_length").append('<a  href="{{ route('kriteria.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
});
</script>
@endsection