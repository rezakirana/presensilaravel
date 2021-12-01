<!DOCTYPE html>
<html>
<head>
	<title>Cetak Antrian</title>
    <style>
        p {
            line-height: 15px;  
            margin: 15px 0;
        }
        h1 {
            line-height: 15px;  
            margin: 15px 0;
        }
        h3 {
            line-height: 15px;  
            margin: 15px 0;
        }
        h4 {
            line-height: 15px;  
            margin: 15px 0;
        }
    </style>
</head>
<body style="text-align: center;">
    <center>
        <h1>PUSKESMAS Karangnongko</h1>
        <p>Jl. Klaten No. 26</p>
        <p>KLATEN</p>
        <p>Telp.027494034</p>
        <hr>
        <h3>{{ $poli }}</h3>
        <br>
        <h1 style="font-size: 72px;">{{ $kodeAntrian }}</h1>
        <h4>{{ $nikPasien }}</h4>
        <h4>{{ $namaPasien }}</h4>
        <p>Hadir Pada :</p>
        <h4>{{ $labelHari }} Jam : {{ $jamDatang }}</h4>
    </center>
</body>
</html>