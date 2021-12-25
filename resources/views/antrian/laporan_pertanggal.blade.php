@extends('layouts/main-admin')
@section('title', 'Laporan')
@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">LAPORAN</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">LAPORAN PERTANGGAL</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <form action="{{ route('download.laporanPertanggal') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Awal</label>
                        <div class="input-group date col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control pull-right" id="datepicker" name="date_awal" required>
                        </div>
                     </div>
                </div>
                <div class="col-md-6">
                    <label for="">Tanggal Akhir</label>
                    <div class="form-group">
                        <div class="input-group date col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control pull-right" id="datepicker2" name="date_akhir" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Download</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@include ('includes.scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function () {
        $('#datepicker').datepicker({
        autoclose: true
        })
    });
    $(function () {
        $('#datepicker2').datepicker({
        autoclose: true
        })
    });
</script>
@endsection