@extends('layouts/main-admin')

@section('title', 'Edit Penyakit')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">PENYAKIT</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Penyakit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('penyakit.update', $penyakit->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Kode Penyakit *</label>
                        <input type="text" class="form-control" name="kodePenyakit" id="kodePenyakit" value="{{ $penyakit->kode }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Penyakit *</label>
                        <input type="text" class="form-control" name="namaPenyakit" id="namaPenyakit" value="{{ $penyakit->penyakit }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Probabilitas *</label>
                        <input type="text" class="form-control" name="probabilitas" id="probabilitas" value="{{ $penyakit->probabilitas }}" required>
                    </div>
                    <div class="form-group">
                        @if ($penyakit->image)
                            <img src="{{ asset('/img/penyakit/'.$penyakit->image) }}" id="imgCurrent" width="70px" height="70px" style="text-align: center;" />
                        @else
                            <img src="{{ asset('/img/default-image.png') }}" id="imgCurrent" width="70px" height="70px" style="text-align: center;" />
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Image</label>
                        <input type="file" class="form-control" name="image" id="inputImage">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Keterangan</label>
                        <textarea class="form-control" name="keteranganPenyakit" rows="3" style="width: 50%">{!! $penyakit->keterangan !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Penanganan *</label>
                        <textarea class="form-control" name="penangananPenyakit" rows="3" style="width: 50%">{!! $penyakit->penanganan !!}</textarea>
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
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    $('#probabilitas').on('change, keyup', function() {
        var currentInput = $(this).val();
        var fixedInput = currentInput.replace(/[A-Za-z!,@#$%^&*()]/g, '');
        $(this).val(fixedInput);
    });

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

    $(document).ready(function() {
       CKEDITOR.replace('keteranganPenyakit');
    });
    
    $(document).ready(function() {
       CKEDITOR.replace('penangananPenyakit');
    });

</script>
@endsection