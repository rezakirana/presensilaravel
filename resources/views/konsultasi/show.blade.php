@extends('layouts/main-admin')

@section('title', 'Konsultasi')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">DETAIL KONSULTASI</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Detail Konsultasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <h4 style="font-weight: bold">Gejala yang Dirasakan:</h4>
                        <div class="list-group">
                            @foreach ($gejala as $key => $item)
                            <a class="list-group-item" style="cursor: pointer">{{ ($key+1) }}. ({{ $item->kode }}) {{ $item->gejala }}</a>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <h4 style="font-weight: bold">Hasil Diagnosa:</h4>
                        <table class="table-bordered">
                            <tr>
                                <td style="width: 20%;padding: 15px;font-weight:bold;">Penyakit</td>
                                <td style="width: 40%;padding: 15px;">{{ $hasilTerpilih['kode_penyakit'] }} - {{ $hasilTerpilih['nama_penyakit'] }}</td>
                                <td rowspan="4" style="padding: 15px;">
                                    @if ($hasilTerpilih['image'])
                                        <center><img src="{{ asset('img/penyakit/'.$hasilTerpilih['image']) }}" style="width: 75%;text-align:center" alt="{{ $hasilTerpilih['nama_penyakit'] }}" /></center>
                                    @else
                                        <center><img src="{{ asset('img/default-image.png') }}" style="width: 75%" alt="{{ $hasilTerpilih['nama_penyakit'] }}" /></center>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;padding: 15px;font-weight:bold;">Persentase</td>
                                <td style="width: 40%;padding: 15px;">{{ $hasilTerpilih['persen'] }} %</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;padding: 15px;font-weight:bold;">Keterangan Penyakit</td>
                                <td style="width: 40%;padding: 15px;">{!! $hasilTerpilih['keterangan'] !!}</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;padding: 15px;font-weight:bold;">Penanganan Penyakit</td>
                                <td style="width: 40%;padding: 15px;">{!! $hasilTerpilih['penanganan'] !!}</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <hr>
                    <h4 style="font-weight: bold">Kemungkinan Hasil Diagnosa yang lain:</h4>
                    @if (count($hasilSemua) > 1)
                        @for ($i = 1; $i < count($hasilSemua); $i++)
                            <div class="form-group">
                                <table class="table-bordered">
                                    <tr>
                                        <td style="width: 20%;padding: 15px;font-weight:bold;">Penyakit</td>
                                        <td style="width: 40%;padding: 15px;">{{ $hasilSemua[$i]['kode_penyakit'] }} - {{ $hasilSemua[$i]['nama_penyakit'] }}</td>
                                        <td rowspan="4" style="padding: 15px;">
                                            @if ($hasilSemua[$i]['image'])
                                                <center><img src="{{ asset('img/penyakit/'.$hasilSemua[$i]['image']) }}" style="width: 75%;text-align:center" alt="{{ $hasilSemua[$i]['nama_penyakit'] }}" /></center>
                                            @else
                                                <center><img src="{{ asset('img/default-image.png') }}" style="width: 75%" alt="{{ $hasilSemua[$i]['nama_penyakit'] }}" /></center>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;padding: 15px;font-weight:bold;">Persentase</td>
                                        <td style="width: 40%;padding: 15px;">{{ $hasilSemua[$i]['persen'] }} %</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;padding: 15px;font-weight:bold;">Keterangan Penyakit</td>
                                        <td style="width: 40%;padding: 15px;">{!! $hasilSemua[$i]['keterangan'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;padding: 15px;font-weight:bold;">Penanganan Penyakit</td>
                                        <td style="width: 40%;padding: 15px;">{!! $hasilSemua[$i]['penanganan'] !!}</td>
                                    </tr>
                                </table>
                            </div>
                        @endfor
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection