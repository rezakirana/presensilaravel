<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Presensi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        textarea {
            border: none;
            outline: none;
        }
    </style>
  </head>
  <body>
    <div class="row" style="margin-bottom: -40px;">
        <div class="col-md-6">
            <h5><b>{{ $data->pertemuan }}</b></h5>
            <h5>{{ $data->jadwal->mapel->nama_mapel }} ({{ $data->materi_pertemuan }})</b></h5>
            <h5>Guru Pengampu : <b>{{ $data->jadwal->guru->nama }}</b></h5>
            <h5>Kelas : <b>{{ $data->jadwal->kelas->nama_kelas }}</b></h5>
        </div>
        <div class="col-md-6" style="text-align:right;">
            <h6>Tahun Ajaran : <b>{{ $data->jadwal->tahun_ajaran->tahun_ajaran }} ({{ $data->jadwal->semester->semester }})</b></h6>    
            <h6><b>{{ ucwords($data->jadwal->hari) }}, {{ $data->jadwal->jam_pelajaran }}</b></h6>    
            <h6>Jumlah Siswa : <b>{{ count($data->data) }} Siswa</b></h6>
        </div>                
    </div>      
    <div class="row" style="margin-top:-20px;">
        <div class="col-md-12"> 
            <p style="margin-bottom:-1px;">Materi Pelajaran : <b>{{ $data->materi_pertemuan }}</b></p>      
        </div>                        
    </div>
    <div class="row">
        <div class="col-md-12">                 
            <p style="margin-bottom:-2px;">Silabus : </p>            
            <textarea name="" id="" cols="20" rows="10"><b>{{ $data->silabus }}</b></textarea>
        </div>
    </div>
    <br><br>
    <h4>Data Siswa</h4>
    <table class="table table-bordered">
        <tr>
            <th>NO</th>
            <th>NIS</th>
            <th>NAMA</th>
            <th>STATUS</th>
            <th>KETERANGAN</th>
        </tr>
        @if (count($data->data))
            @foreach ($data->data as $key => $item)
                <tr>
                    <td>
                        {{ ($key+1) }}                        
                    </td>
                    <td>
                        {{ $item->nis }}
                    </td>
                    <td style="width: 30%">
                        {{ $item->nama }}
                    </td>
                    <td style="width: 30%;">
                        <div class="form-group">
                            @if ($item->status)
                                {{ ucwords($item->status) }}
                            @else
                                -
                            @endif                                    
                        </div>
                    </td>
                    <td style="width: 30%;">
                        @if ($item->keterangan)
                            {{ $item->keterangan }}
                        @else
                            -
                        @endif                                
                    </td>
                </tr>
            @endforeach
        @endif                
    </table>    
  </body>
</html>