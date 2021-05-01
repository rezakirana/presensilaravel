@extends('layouts/main-admin')

@section('title', 'Tambah Bobot Kriteria')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">BOBOT KRITERIA</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah Bobot Kriteria</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('bobot-kriteria.store') }}">
                @csrf
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="item_table">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;">Kriteria</th>
                                    <th style="vertical-align: middle;">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="kriteria[]" id="kriteria" value="{{ $d->id }}">
                                            <input type="text" class="form-control" name="kriteriaNama[]" id="kriteraNama" value="{{ $d->nama }}" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="bobot[]" id="bobot" class="form-control" required>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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