@extends('layouts/main-admin')

@section('title', 'Tambah Penyakit')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">RULES</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah Rules</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('rules.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Penyakit *</label>
                        <select name="penyakit_id" id="penyakit_id" class="form-control" required>
                            <option value="">Pilih Penyakit</option>
                            @foreach ($penyakit as $p)
                                <option value="{{ $p->id }}">{{ $p->kode }} - {{ $p->penyakit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <table class="table">
                            <tr>
                                <td style="width: 90%">
                                    <label for="exampleInputPassword1">Gejala *</label>
                                </td>
                                <td>
                                    <button type="button" id="addGejala" class="btn btn-round btn-sm btn-success"><i class="fa fa-plus"></i> Add</button>
                                </td>
                            </tr>
                        </table>                        
                    </div>
                    <div class="form-group">
                        <table class="table" id="gejalaData">
                            <tr>
                                <td style="width: 85%">
                                    <select name="gejala_id[]" id="penyakit_id[]" class="form-control" required>
                                        <option value="">Pilih Gejala</option>
                                        @foreach ($gejala as $g)
                                            <option value="{{ $g->id }}">{{ $g->kode }} - {{ $g->gejala }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align: right">
                                    <button type="button" id="deleteGejala" class="btn btn-round btn-sm btn-danger" disabled><i class="fa fa-minus"></i> Remove</button>
                                </td>
                            </tr>
                        </table>
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
    
    $(document).ready(function(){
        $(document).on('click', '#addGejala', function() {
            $.ajax({
                url:"{{route('getGejala')}}",
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#gejalaData').append(data.dataGejala);
                }
            });
        });

        $(document).on('click', '#deleteGejala', function(){
            $(this).closest('tr').remove();
        });
      });

</script>
@endsection