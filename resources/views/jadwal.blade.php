@extends('master')
@section('content')
    <section class="Feautes section" style="background-color: white; background-image: linear-gradient(white, #99ffbb);"><hr class="line1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>JADWAL LAYANAN PUSKESMAS KECAMATAN AMIKOM</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">NO</th>
                                    <th rowspan="2">POLI/PELAYANAN</th>
                                    <th rowspan="2">DOKTER</th>
                                    <th colspan="2">JADWAL PELAYANAN</th>
                                </tr>
                                <tr>
                                    <th>HARI</th>
                                    <th>JAM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $key => $sch)
                                    @if (count($sch->data) > 1)
                                        <tr>
                                            <td rowspan="{{ count($sch->data) }}">{{ ($key+1) }}</td>
                                            <td rowspan="{{ count($sch->data) }}">{{ $sch->nama }}</td>
                                            <td>{{ $sch->data[0]->nama_dokter }}</td>
                                            <td>{{ $sch->data[0]->hari }}</td>
                                            <td>{{ $sch->data[0]->jam_praktik }}</td>
                                        </tr>
                                        @for ($i = 1; $i < count($sch->data); $i++)
                                            <td>{{ $sch->data[$i]->nama_dokter }}</td>
                                            <td>{{ $sch->data[$i]->hari }}</td>
                                            <td>{{ $sch->data[$i]->jam_praktik }}</td>
                                        @endfor
                                    @elseif(count($sch->data) == 1)
                                        <tr>
                                            <td>{{ ($key+1) }}</td>
                                            <td>{{ $sch->nama }}</td>
                                            <td>{{ $sch->data[0]->nama_dokter }}</td>
                                            <td>{{ $sch->data[0]->hari }}</td>
                                            <td>{{ $sch->data[0]->jam_praktik }}</td>
                                        </tr>
                                    @else
                                    <tr>
                                        <td>{{ ($key+1) }}</td>
                                        <td>{{ $sch->nama }}</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection