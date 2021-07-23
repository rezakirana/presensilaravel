@extends('layouts/main-admin')

@section('title', 'Penyakit')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">PENYAKIT</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Penyakit</li>
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
                    <th>KODE PENYAKIT</th>
                    <th>NAMA PENYAKIT</th>
                    <th>NILAI PROBABILIAS</th>
                    <th>GAMBAR PENYAKIT</th>
                    <th width="120">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penyakits as $penyakit)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{ $penyakit->kode }}</td>
                        <td>{{ $penyakit->penyakit }}</td>
                        <td>{{ $penyakit->probabilitas }}</td>
                        <td>
                            @if ($penyakit->image)
                                <img src="{{ asset('/img/penyakit/'.$penyakit->image) }}" width="70px" height="70px" style="text-align: center;" alt="{{ $penyakit->penyakit }}" />
                            @else
                                <img src="{{ asset('/img/default-image.png') }}" width="70px" height="70px" style="text-align: center;" alt="{{ $penyakit->penyakit }}" />
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('penyakit.show', $penyakit->id) }}">
                                <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></button>
                            </a>
                            <a href="{{ route('penyakit.edit', $penyakit->id) }}">
                                <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></button>
                            </a>
                            <form id="delete-penyakit-{{$penyakit->id}}" action="/penyakit/{{$penyakit->id}}" method="post" style="display: inline;">
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
            $("#data-admin_length").append('<a  href="{{ route('penyakit.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
@endsection