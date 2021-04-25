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
                <li class="breadcrumb-item active">Edit Alternatif</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="/alternatif/{{$alternatif->id}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama</label>
                                <input type="text" class="form-control" value="{{$alternatif->nama}}" name="nama" id="exampleInputPassword1" placeholder="nama">
                            </div>
                            <div class="form-group">
                                @if (is_null($alternatif->gambar))
                                    <img src="{{ asset('/img/default-image.png') }}" id="imgCurrent" width="70px" height="70px" style="text-align: center;" alt="{{ $alternatif->nama }}" />
                                @else
                                    <img src="{{ asset('/img/image/alternatif/'.$alternatif->gambar) }}" id="imgCurrent" width="70px" height="70px" style="text-align: center;" alt="{{ $alternatif->nama }}" />
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Gambar</label>
                                <input type="file" class="form-control" name="gambar" id="inputImage">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            @foreach($data as $krit)
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{$krit->nama}}</label>
                                <select class="form-control" name="nilai[{{$krit->id}}]">
                                @foreach($krit->sub_kriteria as $sub)
                                    <option value="{{$sub->id}}"
                                    @foreach($alternatif->nilai_alternatif as $nil)
                                    @if ($nil->id_sub_kriteria == $sub->id))
                                        selected="selected"
                                    @endif
                                    @endforeach
                                    >{{$sub->nama}} ( {{$sub->keterangan}} )</option>
                                @endforeach
                                </select>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Ubah</button>
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