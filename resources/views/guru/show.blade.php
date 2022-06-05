@extends('layouts/main-admin')

@section('title', 'Detail Guru')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">GURU</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Detail Guru</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>NUPTK</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>JENIS KELAMIN</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>NOMOR TELPHONE</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>EMAIL</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>PENDIDIKAN</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>ALAMAT</td>
                        <td>: </td>
                    </tr>
                </table>        
            </div>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection