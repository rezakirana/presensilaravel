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
        @include ('includes.flash')
        <div class="card-body">
            <table id="data-admin" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th width="40">NO</th>
                    <th>KODE KELAS</th>
                    <th>NAMA KELAS</th>
                    <th width="120">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- looping --}}
                </tbody>
            </table>
        </div>
    </div>
</section>
@include ('includes.scripts')
    @if (auth()->user()->type == 'admin')
        <script type="text/javascript">
            $(document).ready(function(){
                $("#data-admin_length").append('<a  href="{{ route('kelas.create') }}"> <button type="button" class="btn btn-outline-primary ml-3">Tambah</button></a>');
            });
        </script>
    @endif    
@endsection