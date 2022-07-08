@extends('layouts/main-admin')

@section('title', 'Detail')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">Presensi Detail</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Ubah Presensi</li>
                </ol>
            </div>
            <div>

            </div>

        </div>
    </div>
</div>

<section class="container-fluid">

    <div class="card mb-3">
        <div class="card-body">

            <div class="row mb-2">
                <div class="col-3">
                    <p>Tanggal</p>
                </div>
                <div class="col-9">
                    <p>: {{ $dataPresensi->tanggal }}</p>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-3">
                    <p>Kelas</p>
                </div>
                <div class="col-9">
                    <p>: {{ $dataPresensi->kelas }}</p>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-3">
                    <p>Mapel</p>
                </div>
                <div class="col-9">
                    <p>: {{ $dataPresensi->mapel }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama Siswa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <form role="form" method="post" id="formpresensi" action="{{ route('presensi.update', $dataPresensi->id) }}">
                    @csrf
                    @method("PUT")

                    @foreach ($dataPresensiDetail as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->siswa->nama }}</td>
                            <td>
                                <select class="form-control" name="status[]" id="status" required>
                                    @foreach ($dataStatus as $key => $status)
                                        <option value="{{ $key }}" {{ $siswa->status == $key ? 'SELECTED' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
        <form action="/presensi/{{$dataPresensi->id}}" method="post"
        style="display: inline;">
            @method('DELETE')
            @csrf
                <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus">
                    Hapus
                </button>
            </form>
            <button type="submit" form="formpresensi" class="btn btn-primary">Simpan</button>
            <a href="{{ route('presensi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection
