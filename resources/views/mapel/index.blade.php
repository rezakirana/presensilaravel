@extends('layouts/main-admin')

@section('title', 'Mapel')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">MAPEL</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Mapel</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @if (isset($message))
            @include ('includes.flash')
        @endif
        <div class="card-body">
            <table id="data-admin" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th width="40">NO</th>
                    <th>KODE MAPEL</th>
                    <th>NAMA MAPEL</th>
                    <th width="80">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- looping data mapel --}}
                    @if (count($mapels))
                        @foreach($mapels as $key => $mapel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mapel->kode_mapel }}</td>
                                <td>{{ $mapel->nama_mapel }}</td>
                                <td class="text-center">
                                    <a href="{{ route('mapel.edit',$mapel->id) }}"> 
                                        <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"> 
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <form id="delete-mapel-{{$mapel->id}}" action="/mapel/{{$mapel->id}}" method="post"
                                        style="display: inline;">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>

@include ('includes.scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#data-admin_length").append('<a href="{{ route("mapel.create") }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
@endsection