@extends('layouts/main-admin')

@section('title', 'Kelas')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">KELAS</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Kelas</li>
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
                    <th>KODE KELAS</th>
                    <th>NAMA KELAS</th>
                    <th width="80">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- looping data kelas --}}
                    @if (count($data_kelas))
                        @foreach($data_kelas as $key => $kelas)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kelas->kode_kelas }}</td>
                                <td>{{ $kelas->nama_kelas }}</td>
                                <td class="text-center">
                                    <a href="{{ route('kelas.edit',$kelas->id) }}"> 
                                        <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"> 
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <form id="delete-kelas-{{$kelas->id}}" action="/kelas/{{$kelas->id}}" method="post"
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
            $("#data-admin_length").append('<a href="{{ route("kelas.create") }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
@endsection