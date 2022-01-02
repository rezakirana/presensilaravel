@extends('layouts/main-admin')
@section('title', 'Antrian')
@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">ANTRIAN</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">ANTRIAN</li>
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
                    @if (auth()->user()->type == 'admin')
                        <tr>
                            <th width="40">NO</th>
                            <th>POLI</th>
                            <th>GAMBAR</th>
                            <th>JUMLAH ANTRIAN</th>
                            <th>DATA ANTRIAN BESOK</th>
                        </tr>
                    @elseif(auth()->user()->type == 'dokter')
                        <tr>
                            <th width="40">NO</th>
                            <th>POLI</th>
                            <th>GAMBAR</th>
                            <th>JUMLAH ANTRIAN</th>
                            <th>DATA ANTRIAN BESOK</th>
                        </tr>
                    @else
                        <tr>
                            <th width="40">NO</th>
                            <th>TANGGAL DAFTAR</th>
                            <th>POLI</th>
                            <th>DOKTER</th>
                            <th>NO ANTRIAN</th>
                            <th>JAM HADIR</th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @if (count($data))
                        @if (auth()->user()->type == 'admin')
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ ($key+1) }}</td>
                                    <td>{{ $item->nama }} ({{ $item->kode }})</td>
                                    <td>
                                        @if ($item->gambar)
                                            <img src="{{ asset('/img/poli/'.$item->gambar) }}" width="70px" height="70px" style="text-align: center;" alt="{{ $item->nama }}" />
                                        @else
                                            <img src="{{ asset('/img/default-image.png') }}" width="70px" height="70px" style="text-align: center;" alt="{{ $item->nama }}" />
                                        @endif
                                    </td>
                                    <td>{{ $item->jmlAntrian }}</td>
                                    <td><a href="{{ route('antrianBesok',$item->id) }}">Antrian Hari Berikutnya</a></td>
                                </tr>
                            @endforeach
                        @elseif(auth()->user()->type == 'dokter')
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ ($key+1) }}</td>
                                    <td>{{ $item->namaPoli }} ({{ $item->kode }})</td>
                                    <td>
                                        @if ($item->gambar)
                                            <img src="{{ asset('/img/poli/'.$item->gambar) }}" width="70px" height="70px" style="text-align: center;" alt="{{ $item->nama }}" />
                                        @else
                                            <img src="{{ asset('/img/default-image.png') }}" width="70px" height="70px" style="text-align: center;" alt="{{ $item->nama }}" />
                                        @endif
                                    </td>
                                    <td>{{ $item->jmlAntrian }}</td>
                                    <td><a href="{{ route('antrianBesok',$item->id) }}">Antrian Hari Berikutnya</a></td>
                                </tr>
                            @endforeach
                        @else
                            @foreach ($data as $key => $item)
                                <td>{{ ($key+1) }}</td>
                                <td>{{ $item->tanggal_daftar }}</td>
                                <td>{{ $item->namaPoli }} ({{ $item->kodePoli }})</td>
                                <td>{{ $item->nama_dokter }}</td>
                                <td>{{ $item->kodePoli }} {{ $item->no_antrian }}</td>
                                <td>{{ $item->jam_daftar }}</td>
                            @endforeach
                        @endif
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
@include ('includes.scripts')
@if (Auth::user()->type == 'admin')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#data-admin_length").append('<a  href="{{ route('antrian.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
        });
    </script>
@endif
@endsection