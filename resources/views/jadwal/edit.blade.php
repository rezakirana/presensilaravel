@extends('layouts/main-admin')

@section('title', 'Edit Jadwal')

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
                <li class="breadcrumb-item active">Edit Jadwal</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('jadwal.update',$jadwal->id) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputJK">Tahun Ajaran</label>
                        <select class="form-control" name="tahun_ajaran_id" id="tahun_ajaran_id" required>
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach ($tahunAjaran as $item)
                                <option value="{{ $item->id }}" @if ($jadwal->tahun_ajaran_id == $item->id)
                                    selected
                                @endif>{{ $item->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Kelas</label>
                        <select class="form-control" name="kelas_id" id="kelas_id" required>
                            <option value="">Pilih kelas</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}" @if ($jadwal->kelas_id == $item->id)
                                    selected
                                @endif>{{ $item->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Mata Pelajaran</label>
                        <select class="form-control" name="mapel_id" id="mapel_id" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach ($mapel as $item)
                                <option value="{{ $item->id }}" @if ($jadwal->mapel_id == $item->id)
                                    selected
                                @endif>{{ $item->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Guru Pengampu</label>
                        <select class="form-control" name="guru_id" id="guru_id" required>
                            <option value="">Pilih Guru Pengampu</option>
                            @foreach ($guru as $item)
                                <option value="{{ $item->id }}" @if ($jadwal->guru_id == $item->id)
                                    selected
                                @endif>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Hari</label>
                        <select class="form-control" name="hari" id="hari" required>
                            <option value="">Pilih Hari</option>
                            <option value="senin" @if ($jadwal->hari == 'senin')
                                selected
                            @endif>Senin</option>
                            <option value="selasa" @if ($jadwal->hari == 'selasa')
                                selected
                            @endif>Selasa</option>
                            <option value="rabu" @if ($jadwal->hari == 'rabu')
                                selected
                            @endif>Rabu</option>
                            <option value="kamis" @if ($jadwal->hari == 'kamis')
                                selected
                            @endif>Kamis</option>
                            <option value="jumat" @if ($jadwal->hari == 'jumat')
                                selected
                            @endif>Jumat</option>
                            <option value="sabtu" @if ($jadwal->hari == 'sabtu')
                                selected
                            @endif>Sabtu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jam Pelajaran</label>
                        <input type="text" class="form-control" name="jam_pelajaran" id="jam_pelajaran" value="{{ $jadwal->jam_pelajaran }}" required>
                    </div>                    
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@include ('includes.scripts')
@endsection