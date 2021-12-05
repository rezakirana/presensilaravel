<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
    <style>
        th, td {
            padding: 15px;
        }
    </style>
</head>
<body style="text-align: center;">
    <center>
        <h1>LAPORAN PUSKESMAS Karangnongko</h1>
        <p>Jl. Klaten No. 26</p>
        <p>KLATEN</p>
        <p>Telp.027494034</p>
        <hr>
        <br><br>
        <table border="1">
            <thead>
                <tr>
                    <th style="width: 10%;">NO</th>
                    <th style="width: 30%;">POLI</th>
                    <th style="width: 60%;">JUMLAH PASIEN TERDAFTAR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{{ $item['nama'] }} ({{ $item['kode'] }})</td>
                        <td>{{ $item['jmlAntrian'] }} pasien</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </center>
</body>
</html>