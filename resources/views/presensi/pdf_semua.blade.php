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
        .page-break {
            page-break-after: always;
        }
        .table {
            border-spacing: 20px;
        }
        .td {
            padding: 10px;
        }
    </style>
  </head>
  <body>
      @if (count($data))
          @foreach ($data as $key => $presensi)
            <div class="row" style="margin-bottom: -40px;">
                <div class="col-md-6">
                    <h5><b>{{ $presensi->pertemuan }}</b></h5>
                    <h5>{{ $presensi->jadwal->mapel->nama_mapel }} ({{ $presensi->materi_pertemuan }})</b></h5>
                    <h5>Guru Pengampu : <b>{{ $presensi->jadwal->guru->nama }}</b></h5>
                    <h5>Kelas : <b>{{ $presensi->jadwal->kelas->nama_kelas }}</b></h5>
                </div>
                <div class="col-md-6" style="text-align:right;">
                    <h6>Tahun Ajaran : <b>{{ $presensi->jadwal->tahun_ajaran->tahun_ajaran }} ({{ $presensi->jadwal->semester->semester }})</b></h6>    
                    <h6><b>{{ ucwords($presensi->jadwal->hari) }}, {{ $presensi->jadwal->jam_pelajaran }}</b></h6>    
                    @php
                        $dataSiswa = null;
                        $dataSiswa = json_decode($presensi->data);
                    @endphp
                    <h6>Jumlah Siswa : <b>{{ count($dataSiswa) }} Siswa</b></h6>
                </div>                
            </div>      
            <div class="row" style="margin-top:-20px;">
                <div class="col-md-12"> 
                    <p style="margin-bottom:-1px;">Materi Pelajaran : <b>{{ $presensi->materi_pertemuan }}</b></p>      
                </div>                        
            </div>
            <div class="row">
                <div class="col-md-12">                 
                    <p style="margin-bottom:-2px;">Silabus : </p>            
                    <textarea name="" id="" cols="20" rows="10"><b>{{ $presensi->silabus }}</b></textarea>
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
                @if (count($dataSiswa))
                    @foreach ($dataSiswa as $key2 => $item)
                        <tr>
                            <td>
                                {{ ($key2+1) }}                        
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
            {{-- @if (count($data) != ($key+1)) --}}
                <div class="page-break"></div>
            {{-- @endif             --}}
          @endforeach
          <table border="1" class="table">
            <thead>dataSiswa
                <tr>
                    <td class="td" style="text-align:center;font-weight:bold;">NO</td>
                    <td class="td" style="text-align:center;font-weight:bold;">NIS</td>
                    <td class="td" style="text-align:center;font-weight:bold;">NAMA</td>
                    <td class="td" style="text-align:center;font-weight:bold;">HADIR</td>
                    <td class="td" style="text-align:center;font-weight:bold;">IZIN</td>
                    <td class="td" style="text-align:center;font-weight:bold;">SAKIT</td>
                    <td class="td" style="text-align:center;font-weight:bold;">ALPHA</td>
                </tr>                
            </thead>
            <tbody>                
                @foreach ($getNamaSiswa as $kunci => $ket)
                    <tr>
                        <td class="td">{{ ($kunci+1) }}</td>
                        <td class="td">{{ $ket['nis'] }}</td>
                        <td class="td">{{ $ket['nama'] }}</td>
                        <td class="td" style="text-align:center;">{{ $ket['hadir'] }} kali</td>
                        <td class="td" style="text-align:center;">{{ $ket['izin'] }} kali</td>
                        <td class="td" style="text-align:center;">{{ $ket['sakit'] }} kali</td>
                        <td class="td" style="text-align:center;">{{ $ket['alpha'] }} kali</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
      @endif        
  </body>
</html>