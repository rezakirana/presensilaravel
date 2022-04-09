@extends('layouts/main-admin')

@section('title', 'Lengkapi Presensi')

@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">PRESENSI</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah Presensi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5><b>{{ $data->pertemuan }}</b></h5>
                    <h5>{{ $data->jadwal->mapel->nama_mapel }} ({{ $data->materi_pertemuan }})</b></h5>
                    <h5>Guru Pengampu : <b>{{ $data->jadwal->guru->nama }}</b></h5>
                    <h5>Kelas : <b>{{ $data->jadwal->kelas->nama_kelas }}</b></h5>
                </div>
                <div class="col-md-6" style="text-align:right;">
                    <h6>Tahun Ajaran : <b>{{ $data->jadwal->tahun_ajaran->tahun_ajaran }} ({{ $data->jadwal->semester->semester }})</b></h6>    
                    <h6><b>{{ ucwords($data->jadwal->hari) }}, {{ $data->jadwal->jam_pelajaran }}</b></h6>    
                    <h6>Jumlah Siswa : <b>{{ count($data->data) }}</b></h6>
                </div>
            </div>              
            <hr>
            <br>                      
            <form role="form" method="post" action="{{ route('presensi.update',$data->id) }}">
                @csrf                
                @method('put')
                <table class="table">
                    <tr>
                        <th>NO</th>
                        <th>NIS</th>
                        <th>NAMA</th>
                        <th>STATUS</th>
                        <th>KETERANGAN</th>
                    </tr>
                    @foreach ($data->data as $key => $item)
                        <tr>
                            <td>
                                {{ ($key+1) }}
                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                            </td>
                            <td>
                                {{ $item->nis }}
                                <input type="hidden" name="nis[]" value="{{ $item->nis }}">
                            </td>
                            <td style="width: 30%">
                                {{ $item->nama }}
                                <input type="hidden" name="nama[]" value="{{ $item->nama }}">
                            </td>
                            <td style="width: 30%;">
                                <div class="form-group">
                                    @if ($item->status)
                                        <label class="radio-inline" style="cursor: pointer;">
                                            <input type="radio" name="siswa{{ $key }}" class="labelHadir" data-id="{{ $item->id }}" value="hadir" @if ($item->status == 'hadir')
                                                checked=""
                                            @endif style="cursor: pointer;"> Hadir
                                        </label>
                                        <label class="radio-inline" style="cursor: pointer;">
                                            <input type="radio" name="siswa{{ $key }}" class="labelSakit" data-id="{{ $item->id }}" value="sakit" @if ($item->status == 'sakit')
                                                checked=""
                                            @endif style="cursor: pointer;"> Sakit
                                        </label>
                                        <label class="radio-inline" style="cursor: pointer;">
                                            <input type="radio" name="siswa{{ $key }}" class="labelIjin" data-id="{{ $item->id }}" value="izin" @if ($item->status == 'ijin' || $item->status == 'izin')
                                                checked=""
                                            @endif style="cursor: pointer;"> Izin
                                        </label>
                                        <label class="radio-inline" style="cursor: pointer;">
                                            <input type="radio" name="siswa{{ $key }}" class="labelAlpha" data-id="{{ $item->id }}" value="alpha" @if ($item->status == 'alpha')
                                                checked=""
                                            @endif style="cursor: pointer;"> Alpha
                                        </label>
                                    @else
                                        <label class="radio-inline" style="cursor: pointer;">
                                            <input type="radio" name="siswa{{ $key }}" class="labelHadir" data-id="{{ $item->id }}" value="hadir" checked="" style="cursor: pointer;"> Hadir
                                        </label>
                                        <label class="radio-inline" style="cursor: pointer;">
                                            <input type="radio" name="siswa{{ $key }}" class="labelSakit" data-id="{{ $item->id }}" value="sakit" style="cursor: pointer;"> Sakit
                                        </label>
                                        <label class="radio-inline" style="cursor: pointer;">
                                            <input type="radio" name="siswa{{ $key }}" class="labelIjin" data-id="{{ $item->id }}" value="izin" style="cursor: pointer;"> Izin
                                        </label>
                                        <label class="radio-inline" style="cursor: pointer;">
                                            <input type="radio" name="siswa{{ $key }}" class="labelAlpha" data-id="{{ $item->id }}" value="alpha" style="cursor: pointer;"> Alpha
                                        </label>
                                    @endif                                    
                                </div>
                            </td>
                            <td style="width: 30%;">
                                @if ($item->keterangan)
                                    <input type="text" class="form-control" name="keterangan[]" id="keterangan-{{ $item->id }}" value="{{ $item->keterangan }}" style="display:block;" required>
                                @else
                                    <input type="text" class="form-control" name="keterangan[]" id="keterangan-{{ $item->id }}" style="display:none;">
                                @endif                                
                            </td>
                        </tr>
                    @endforeach
                </table>                
                <hr>                                     
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@include ('includes.scripts')
<script>
    $(document).on('change','.labelHadir',function(){
        event.preventDefault();
        let id = $(this).data('id');
        let idInput = "keterangan-"+id;
        document.getElementById(idInput).style.display = "none";
        document.getElementById(idInput).required = false;
        document.getElementById(idInput).value = "";
    });
    
    $(document).on('change','.labelSakit',function(){
        event.preventDefault();
        let id = $(this).data('id');
        let idInput = "keterangan-"+id;
        document.getElementById(idInput).style.display = "block";
        document.getElementById(idInput).required = true;
        document.getElementById(idInput).focus();
    });
    
    $(document).on('change','.labelAlpha',function(){
        event.preventDefault();
        let id = $(this).data('id');
        let idInput = "keterangan-"+id;
        document.getElementById(idInput).style.display = "block";
        document.getElementById(idInput).required = true;
        document.getElementById(idInput).focus();
    });
    
    $(document).on('change','.labelIjin',function(){
        event.preventDefault();
        let id = $(this).data('id');
        let idInput = "keterangan-"+id;
        document.getElementById(idInput).style.display = "block";
        document.getElementById(idInput).required = true;
        document.getElementById(idInput).focus();
    });

</script>
@endsection