@extends('layouts/main-admin')
@section('title', 'Antrian')
@section('cssAdded')
<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 34px;
    }
    
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }
    </style>
@endsection
@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 text-dark">ANTRIAN Poli <b>{{ $poli->nama }}</b> HARI INI</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">ANTRIAN <b>{{ $poli->nama }}</b> HARI INI</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container-fluid">    
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
                        <th>STATUS</th>
                        <th>AKSI</th>
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
                        <td>
                            @if ($item->status)
                                <i class="fa fa-check" style="color: green;"></i> Sudah diperiksa
                            @else
                                <i class="fa fa-times" style="color: red;"></i> Belum diperiksa                                
                            @endif
                        </td>
                        <td>
                            @if ($item->status)
                                <label class="switch">
                                    <input type="checkbox" data-id="{{ $item->id }}" class="btnDisable" checked>
                                    <span class="slider round"></span>
                                </label>    
                            @else
                                <label class="switch">
                                    <input type="checkbox" data-id="{{ $item->id }}" class="btnEnable">
                                    <span class="slider round"></span>
                                </label>
                            @endif
                        </td>
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
    let url = "{{ Request::url() }}";
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
    })
    $('.btnDisable').on('click',function(e){
        event.preventDefault();        
        let antrianId = $(this).data('id');
        let status = 0;
        $.ajax({
           url:"{{route('disabledAntrian')}}",
           type: "GET",
           data: {
               _token: '{{ csrf_token() }}',
               antrianId: antrianId,
               status: status
           },
           cache: false,
           dataType: 'json',
           success: function(data){
                window.location.href = url;    
           }
       });
    })
    $('.btnEnable').on('click',function(e){
        event.preventDefault();        
        let antrianId = $(this).data('id');
        let status = 1;
        $.ajax({
           url:"{{route('enabledAntrian')}}",
           type: "GET",
           data: {
               _token: '{{ csrf_token() }}',
               antrianId: antrianId,
               status: status
           },
           cache: false,
           dataType: 'json',
           success: function(data){
            window.location.href = url;    
           }
       });
    })
</script>
@endsection