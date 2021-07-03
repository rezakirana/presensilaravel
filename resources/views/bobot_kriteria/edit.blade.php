@extends('layouts/main-admin')

@section('title', 'Edit Bobot Kriteria')

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
                <li class="breadcrumb-item active">Edit Bobot Kriteria</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <form role="form" method="post" action="{{ route('bobot-kriteria.simpanUpdate') }}">
                @csrf
                @method('PUT')
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
                                            <input type="hidden" name="kriteria[]" id="kriteria" value="{{ $d->id_kriteria }}">
                                            <input type="text" class="form-control" name="kriteriaNama[]" id="kriteraNama" value="{{ $d->nama }}" readonly>
                                        </td>
                                        <td>
                                            <select id="bobot" name="bobot[]" class="form-control" required>
                                                <option value="5" @if ($d->bobot == '5')
                                                    selected
                                                @endif>Sangat Penting</option>
                                                <option value="4" @if ($d->bobot == '4')
                                                    selected
                                                @endif>Penting</option>
                                                <option value="3" @if ($d->bobot == '3')
                                                    selected
                                                @endif>Sedang</option>
                                                <option value="2" @if ($d->bobot == '2')
                                                    selected
                                                @endif>Kurang Penting</option>
                                                <option value="1" @if ($d->bobot == '1')
                                                    selected
                                                @endif>Sangat Tidak Penting</option>
                                            </select>
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