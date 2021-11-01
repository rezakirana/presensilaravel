@extends('layouts/main-admin')

@section('title', 'Pasien')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">Manajemen Pasien</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Pasien</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('pasien.update',$pasien->id) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputNama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ $pasien->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="jk">
                            <option value="laki-laki" @if ($pasien->jk == 'laki=laki')
                                selected=""
                            @endif>Laki-Laki</option>
                            <option value="perempuan" @if ($pasien->jk == 'perempuan')
                                selected=""
                            @endif>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik" value="{{ $pasien->nik }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">TTL</label>
                        <div class="input-group date col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control pull-right" id="datepicker" name="ttl" value="{{ $ttl }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPoli">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" >{{ $pasien->alamat }}</textarea>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function () {
        //Date picker
        $('#datepicker').datepicker({
        autoclose: true
        })
    });
</script>
@endsection