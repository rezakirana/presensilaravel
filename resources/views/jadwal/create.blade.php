@extends('layouts/main-admin')

@section('title', 'Jadwal Praktik')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">Manajemen Jadwal Praktik</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah Jadwal Praktik</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <h3>Profil Account</h3>
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('jadwal.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputJK">Dokter</label>
                        <select class="form-control" name="dokter_id" id="dokter_id" required>
                            <option value="">--Pilih Dokter--</option>
                            @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->nama_dokter }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Hari</label>
                        <select class="form-control" name="hari" id="hari" required>
                            <option value="">--Pilih Hari--</option>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInputNama">Mulai</label>
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <input id="timepicker1" type="text" class="form-control input-small" name="mulai" required>
                                        <span class="input-group-addon">&nbsp;<i class="fa fa-clock fa-2x"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputNama">Selesai</label>
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <input id="timepicker2" type="text" class="form-control input-small" name="selesai" required>
                                        <span class="input-group-addon">&nbsp;<i class="fa fa-clock fa-2x"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@include ('includes.scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $('#timepicker1').timepicker({
        defaultTime: 'value',
        minuteStep: 1,
        disableFocus: true,
        template: 'dropdown',
        showMeridian:false
    });
    $('#timepicker2').timepicker({
        defaultTime: 'value',
        minuteStep: 1,
        disableFocus: true,
        template: 'dropdown',
        showMeridian:false
    });
</script>
@endsection