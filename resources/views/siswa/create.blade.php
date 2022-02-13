@extends('layouts/main-admin')

@section('title', 'Tambah Siswa')

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
                <li class="breadcrumb-item active">Tambah Siswa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('siswa.store') }}">
                @csrf
                <div class="card-body">
                    <h4>Data Siswa</h4>
                    <div class="form-group">
                        <label for="exampleInputJK">Kelas</label>
                        <select class="form-control" name="kelas_id" id="kelas_id" required>
                            <option value="">Pilih kelas</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">NIS</label>
                        <input type="text" class="form-control" name="nis" id="nis" placeholder="nis" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="tempat lahir" required>
                    </div>                    
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">Tanggal Lahir</label>
                        <div class="input-group date col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control pull-right" id="datepicker" name="tgl_lahir" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJK">Jenis Kelamin</label>
                        <select class="form-control" name="gender" id="gender" required>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPendidikanTerakhir">Nomor Telphone</label>
                        <input id="phone_number" type="number" class="form-control form-control-user @error('phone_number') is-invalid @enderror" name="phone_number" id="phoneValidation" placeholder="nomor telphone" required autocomplete="phone number" style="-webkit-appearance: none;margin: 0;">
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Orang Tua</label>
                        <input type="text" class="form-control" name="nama_ortu" id="nama_ortu" placeholder="nama orang tua" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="10" placeholder="alamat" required></textarea>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function () {
        //Date picker
        $('#datepicker').datepicker({
        autoclose: true
        })
    });
    $('#phoneValidation').on('keyup', function () {
        this.value = this.value.replace(/[^0-9]/gi, '')
      });
</script>
@endsection