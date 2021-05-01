@extends('layouts/main-admin')

@section('title', 'Alternatif')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">ALTERNATIF</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Alternatif</li>
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
                    <th>THUMBNAIL</th>
                    <th width="240">NILAI ALTERNATIF</th>
                    @if (Auth::user()->is_admin == 1)
                        <th width="80">AKSI</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $alt)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$alt->nama}}</td>
                        <td>
                            @if (is_null($alt->gambar))
                                <img src="{{ asset('/img/default-image.png') }}" width="70px" height="70px" style="text-align: center;" alt="{{ $alt->nama }}" />
                            @else
                                <img src="{{ asset('/img/image/alternatif/'.$alt->gambar) }}" width="70px" height="70px" style="text-align: center;" alt="{{ $alt->nama }}" />
                            @endif
                        </td>
                        <td>
                            <a href="/alternatif/{{$alt->id}}">
                            <span class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Ubah">Lihat Nilai Alternatif</span>
                            </a>
                        </td>
                        @if (Auth::user()->is_admin == 1)
                            <td class="text-center">
                                <a href="/alternatif/{{$alt->id}}/edit">
                                <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></button>
                                </a>
                                <form id="delete-alternatif-{{$alt->id}}" action="/alternatif/{{$alt->id}}" method="post" style="display: inline;">
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
<script type="text/javascript">
$(document).ready(function(){
    $("#data-admin_length").append('<a  href="{{ route('alternatif.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
});
</script>
@endsection