@extends('layouts/main-admin')

@section('title', 'Detail Jadwal')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">JADWAL</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Detail Jadwal</li>
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
                        <td>KELAS</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>GURU PENGAMPU</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>MATA PELAJARAN</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>HARI</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>JAM PELAJARAN</td>
                        <td>: </td>
                    </tr>                                                           
                </table>   
                <hr>
                <h4>Data Siswa</h4>     
                <table class="table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIS</th>
                            <th>NAMA</th>
                            <th>JENIS KELAMIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- looping data siswa --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection