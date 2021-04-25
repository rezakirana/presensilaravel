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
                <li class="breadcrumb-item active">Nilai Alternatif</li>
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
                <div class="col-md-6 col-sm-12">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width: 30%;">Nama Alternatif</td>
                                <td style="width: 70%;">{{$data->nama}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Image</td>
                                <td style="width: 70%;">
                                    @if (is_null($data->gambar))
                                        <img src="{{ asset('/img/default-image.png') }}" width="70px" height="70px" style="text-align: center;" alt="{{ $data->nama }}" />
                                    @else
                                        <img src="{{ asset('/img/image/alternatif/'.$data->gambar) }}" width="70px" height="70px" style="text-align: center;" alt="{{ $data->nama }}" />
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 col-sm-12">
                    <table id="data-admin" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA KRITERIA</th>
                                <th>NILAI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data->nilai_alternatif as $nil)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$nil->sub_kriteria->kriteria->nama}}</td>
                                <td>{{$nil->sub_kriteria->nama}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@include ('includes.scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#data-admin_length").append('<a  href="/alternatif/{{$data->id}}/edit"> <button type="button" class="btn btn-outline-primary ml-3">UBAH</button></a>');
    });
    </script>
@endsection