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
                <li class="breadcrumb-item active">Edit Rules</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('rules.update', $rule->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Penyakit *</label>
                        <select name="penyakit_id" id="penyakit_id" class="form-control" required>
                            <option value="">Pilih Penyakit</option>
                            @foreach ($penyakit as $p)
                                <option value="{{ $p->id }}" @if ($p->id == $rule->penyakit_id)
                                    selected
                                @endif>{{ $p->kode }} - {{ $p->penyakit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Gejala *</label>
                        <select name="gejala_id" id="gejala_id" class="form-control" required>
                            <option value="">Pilih Gejala</option>
                            @foreach ($gejala as $g)
                                <option value="{{ $g->id }}" @if ($g->id == $rule->gejala_id)
                                    selected
                                @endif>{{ $g->kode }} - {{ $g->gejala }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bobot *</label>
                        <input type="text" class="form-control" name="bobot" id="bobot" value="{{ $rule->bobot }}" required>
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
    $('#bobot').on('change, keyup', function() {
        var currentInput = $(this).val();
        var fixedInput = currentInput.replace(/[A-Za-z!,@#$%^&*()]/g, '');
        $(this).val(fixedInput);
    });
</script>
@endsection