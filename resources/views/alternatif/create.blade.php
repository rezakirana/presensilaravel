@extends('layouts/main-admin')

@section('title', 'Alternatif')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">ALTERNATIF</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah Alternatif</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('alternatif.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Alternatif</label>
                            <input type="text" class="form-control" name="nama" id="exampleInputPassword1" placeholder="nama">
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('/img/default-image.png') }}" id="imgCurrent" width="70px" height="70px" style="text-align: center;" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Gambar</label>
                            <input type="file" class="form-control" name="gambar" id="inputImage">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        @foreach($kriterias as $kriteria)
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{$kriteria->nama}}</label>
                            <select class="form-control" name="nilai[{{$kriteria->id}}]">
                                @foreach($kriteria->sub_kriteria as $subKriteria)
                                    <option value="{{$subKriteria->id}}">{{$subKriteria->nama}} ( {{$subKriteria->keterangan}} )</option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
                <div class="card-footer" style="background-color: #fff;">
                    <button type="submit" class="btn btn-primary float-right">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</section>
@include ('includes.scripts')
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