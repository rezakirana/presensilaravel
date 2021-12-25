@extends('layouts/main-admin')

@section('title', 'Poli')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">POLI</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">POLI</li>
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
                    <th>KODE</th>
                    <th>POLI</th>
                    <th>ICON</th>
                    @if (auth()->user()->type == 'admin')
                        <th width="80">AKSI</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($poli as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            @if ($item->gambar)
                                <img src="{{ asset('/img/poli/'.$item->gambar) }}" width="70px" height="70px" style="text-align: center;" alt="{{ $item->nama }}" />
                            @else
                                <img src="{{ asset('/img/default-image.png') }}" width="70px" height="70px" style="text-align: center;" alt="{{ $item->nama }}" />
                            @endif    
                        </td>
                        @if (auth()->user()->type == 'admin')
                            <td class="text-center">
                                <a href="{{ route('poli.edit', $item->id) }}">
                                    <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></button>
                                </a>
                                <form id="delete-user-{{$item->id}}" action="/poli/{{$item->id}}" method="post" style="display: inline;">
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
    @if (auth()->user()->type == 'admin')
        <script type="text/javascript">
            $(document).ready(function(){
                $("#data-admin_length").append('<a  href="{{ route('poli.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
            });
        </script>
    @endif
@endsection