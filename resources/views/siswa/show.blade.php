@extends('layouts/main-admin')

@section('title', 'Detail Siswa')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">SISWA</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Detail Siswa</li>
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
                        <td>NIS</td>
                        <td>: {{ $siswa->nis }}</td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td>: {{ $siswa->nama }}</td>
                    </tr>
                    <tr>
                        <td>KELAS</td>
                        <td>: {{ $siswa->kelas->nama_kelas }}</td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td>: {{ $siswa->tempat_lahir }}, {{ $siswa->tgl_lahir->isoFormat('D MMMM Y') }}</td>
                    </tr>
                    <tr>
                        <td>JENIS KELAMIN</td>
                        <td>: {{ $siswa->gender }}</td>
                    </tr>
                    <tr>
                        <td>NOMOR TELPHONE</td>
                        <td>: {{ $siswa->phone_number }}</td>
                    </tr>
                    <tr>
                        <td>EMAIL</td>
                        <td>: {{ $siswa->email }}</td>
                    </tr>
                    <tr>
                        <td>NAMA ORANG TUA/WALI</td>
                        <td>: {{ $siswa->nama_ortu }}</td>
                    </tr>
                    <tr>
                        <td>ALAMAT</td>
                        <td>: {{ $siswa->alamat }}</td>
                    </tr>
                </table>        
            </div>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection