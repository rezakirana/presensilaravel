<!DOCTYPE html>
<html>
<head>
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>    
    <h1>{{ $data['title'] }}</h1>
    <p>Assalammualaikum, Bapak/Ibu <b>{{ $data['namaWali'] }}</b> sebagai Orang Tua Wali Siswa atas nama : </p>
    <hr>
    <br>
    <table border="0">
        <tr>
            <td>Nama Siswa</td>
            <td>: <b>{{ $data['namaSiswa'] }}</b></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <b>{{ $data['gender'] }}</b></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <b>{{ $data['alamat'] }}</b></td>
        </tr>
        <tr>
            <td>Tahun Ajaran</td>
            <td>: <b>{{ $data['tahun_ajaran'] }}</b></td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>: <b>{{ $data['semester'] }}</b></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>: <b>{{ $data['kelas'] }}</b></td>
        </tr>
    </table>
    <br>
    <p>Tidak mengikuti pelajaran pada : </p>
    <table border="0">
        <tr>
            <td>Hari</td>
            <td>: <b>{{ ucwords($data['hari']) }}, {{ $data['tanggal']->format('d/m/Y') }}</b></td>
        </tr>
        <tr>
            <td>Jam Pelajaran</td>
            <td>: <b>{{ $data['jamPelajaran'] }}</b></td>
        </tr>
        <tr>
            <td>Mata Pelajaran</td>
            <td>: <b>{{ $data['mapel'] }}</b></td>
        </tr>
        <tr>
            <td>Guru Pengampu</td>
            <td>: <b>{{ $data['guru'] }}</b></td>
        </tr>
        <tr>
            <td>Status Kehadiran</td>
            <td>: <b>{{ $data['status'] }}</b></td>
        </tr>
        <tr>
            <td>Alasan Tidak Hadir</td>
            <td>: <b>{{ $data['alasan'] }}</b></td>
        </tr>
    </table>    
    <br>
    <p>Demikian laporan presensi harian siswa yang dapat kami sampaikan, atas perhatiannya diucapkan terima kasih!</p>
    
</body>
</html>