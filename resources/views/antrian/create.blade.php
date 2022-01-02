@extends('layouts/main-admin')
@section('title', 'Antrian')
@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">TAMBAH ANTRIAN</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">TAMBAH ANTRIAN</li>
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
                        <th>POLI</th>
                        <th>GAMBAR</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($poli as $key => $item)
                    <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            @if ($item->gambar)
                                <img src="{{ asset('/img/poli/'.$item->gambar) }}" width="70px" height="70px" style="text-align: center;" alt="{{ $item->nama }}" />
                            @else
                                <img src="{{ asset('/img/default-image.png') }}" width="70px" height="70px" style="text-align: center;" alt="{{ $item->nama }}" />
                            @endif
                        </td>
                        <td>
                            @if ($item->jadwal)
                                <a href="{{ route('tambahAntrian',$item->id) }}" class="btn btn-success">Tambah Antrian</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection