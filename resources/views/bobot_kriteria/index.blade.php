@extends('layouts/main-admin')

@section('title', 'Alternatif')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">BOBOT KRITERIA</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Bobot Kriteria</li>
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
                    <th>KRITERIA</th>
                    <th>BOBOT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $alt)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$alt->nama}}</td>
                        <td>
                            @if ($alt->bobot == '1')
                                Sangat Tidak Penting
                            @elseif($alt->bobot == '2')
                                Kurang Penting
                            @elseif($alt->bobot == '3')
                                Sedang
                            @elseif($alt->bobot == '4')
                                Penting
                            @else
                                Sangat Penting
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
@if (count($data) <= 0)
<script type="text/javascript">
    $(document).ready(function(){
        $("#data-admin_length").append('<a  href="{{ route('bobot-kriteria.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
    });
</script>
@else
<script type="text/javascript">
    $(document).ready(function(){
        $("#data-admin_length").append('<a  href="{{ route('bobot-kriteria.ubah') }}"> <button type="button" class="btn btn-outline-primary ml-3">Edit</button></a>');
    });
</script>
@endif
@endsection