@extends('layouts/main-admin')

@section('title', 'Poli')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">Manajemen Poli</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Poli</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('poli.update',$poli->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputNama">Kode Poli</label>
                        <input type="text" class="form-control" name="kode" id="kode" value="{{ $poli->kode }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ $poli->nama }}" required>
                    </div>
                    <div class="form-group">
                        @if ($poli->gambar)
                            <img src="{{ asset('/img/poli/'.$poli->gambar) }}" id="imgCurrent" width="70px" height="70px" style="text-align: center;" />                        
                        @else
                            <img src="{{ asset('/img/default-image.png') }}" id="imgCurrent" width="70px" height="70px" style="text-align: center;" />
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Icon Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="inputImage">
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
    function getURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#imgCurrent').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $('#inputImage').on('change',function(e){
        // get url image
        getURL(this);
        // get file name
        var fileName = e.target.files[0].name;
    });
</script>
@endsection