@extends('layouts/main-admin')
@section('title', 'Antrian')
@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">ANTRIAN Poli <b>{{ $poli->nama }}</b> HARI SELANJUTNYA</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">ANTRIAN <b>{{ $poli->nama }}</b> HARI SELANJUTNYA</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">
    <div class="card-body">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Tanggal Antrian</label>
                <div class="input-group date col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="text" class="form-control pull-right" id="datepicker" name="date_awal" value="{{$besok}}" required>&nbsp;&nbsp;&nbsp;
                    <button id="checkAntrian" class="btn btn-info" type="button">Check</button>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="card">
        @include ('includes.flash')
        <div class="card-body">
            <table id="data-admin" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="40">NO</th>
                        <th>PASIEN</th>
                        <th>JAM DAFTAR</th>
                        <th>NO ANTRIAN</th>
                        <th>POLI</th>
                        <th>DOKTER</th>
                    </tr>
                </thead>
                <tbody id="gantiData">
                    @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jam_daftar }}</td>
                        <td>{{ $poli->kode }}{{ $item->no_antrian }}</td>
                        <td>{{ $poli->nama }}</td>
                        <td>{{ $item->nama_dokter }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
    $('#checkAntrian').on('click',function(e){
        event.preventDefault();
        let tgl = $('#datepicker').val();
        let poliId = "{{ $poli->id }}";
        $.ajax({
           url:"{{route('get.dataAntrian')}}",
           type: "GET",
           data: {
               _token: '{{ csrf_token() }}',
               tgl: tgl,
               poliId: poliId
           },
           cache: false,
           dataType: 'json',
           success: function(data){
                $('#gantiData').empty();
                $('#gantiData').append(data.data);    
           }
       });
        // var fileName = e.target.files[0].name;
        // $(this).next('.custom-file-label').html(fileName);
    })
</script>
@endsection