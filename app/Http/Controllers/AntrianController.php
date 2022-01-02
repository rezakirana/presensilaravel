<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Antrian;
use App\Model\Poli;
use App\Model\Dokter;
use App\Model\Pasien;
use App\Model\Jadwal;
use DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $today = \Carbon\Carbon::today()->toDateString();
        if ($user->type == 'admin') {
            $data = Poli::all();
            foreach ($data as $key => $value) {
                $data2 = Antrian::join('jadwal','jadwal.id','=','antrian.jadwal_id')
                        ->join('dokter','dokter.id','=','jadwal.dokter_id')
                        ->join('poli','poli.id','=','dokter.poli_id')
                        ->where('poli.id',$value->id)
                        ->whereDate('antrian.tanggal_daftar',$today)
                        ->select([
                            'antrian.id as jmlAntrian'
                            ])
                        ->count();
                $value->jmlAntrian = $data2;
            }
        }elseif ($user->type == 'dokter') {           
            $dt = \Carbon\Carbon::now();
            $today = $dt->toDateString();
            $day = $dt->format('l');
            $dayLabel = null;
            if ($day == 'Sunday') {
                $dayLabel = 'Minggu';
            }elseif ($day == 'Monday') {
                $dayLabel = 'Senin';
            }elseif ($day == 'Tuesday') {
                $dayLabel = 'Selasa';
            }elseif ($day == 'Wednesday') {
                $dayLabel = 'Rabu';
            }elseif ($day == 'Thursday') {
                $dayLabel = 'Kamis';
            }elseif ($day == 'Friday') {
                $dayLabel = 'Jumat';
            }elseif ($day == 'Saturday') {
                $dayLabel = 'Sabtu';
            }
            $data = Poli::join('dokter','poli.id','=','dokter.poli_id')
                        ->join('jadwal','jadwal.dokter_id','=','dokter.id')
                        ->where([
                            'dokter.id' => $user->dokter->id,
                            'jadwal.hari' => $dayLabel
                            ])
                        ->select([
                            'poli.id',
                            'poli.kode',
                            'poli.nama as namaPoli',
                            'poli.gambar',
                        ])
                        ->get();
            if (count($data)) {
                foreach ($data as $key => $value) {
                    $data2 = Antrian::join('jadwal','jadwal.id','=','antrian.jadwal_id')
                            ->join('dokter','dokter.id','=','jadwal.dokter_id')
                            ->join('poli','poli.id','=','dokter.poli_id')
                            ->where('poli.id',$value->id)
                            ->whereDate('antrian.tanggal_daftar',$today)
                            ->select([
                                'antrian.id as jmlAntrian'
                                ])
                            ->count();
                    $value->jmlAntrian = $data2;
                }
            }
        }else {
            $dt = \Carbon\Carbon::now();
            $data = Antrian::join('pasien','pasien.id','=','antrian.pasien_id')
                            ->join('jadwal','jadwal.id','=','antrian.jadwal_id')
                            ->join('dokter','dokter.id','=','jadwal.dokter_id')
                            ->join('poli','poli.id','=','dokter.poli_id')
                            ->where('antrian.pasien_id',$user->pasien->id)
                            ->where('antrian.tanggal_daftar','>=',$dt->toDateString())
                            ->select([
                                'poli.kode as kodePoli',
                                'poli.nama as namaPoli',
                                'dokter.nama_dokter',
                                'antrian.no_antrian',
                                'antrian.tanggal_daftar',
                                'antrian.jam_daftar'
                            ])->get();
        }
        $this->data['data'] = $data;
        
        return view ('antrian.index',$this->data);
    }

    public function antrian_besok($id)
    {
        $user = Auth::user();
        $besok = \Carbon\Carbon::today()->addDay(1);
        $poli = Poli::findOrFail($id);
        $data = Antrian::join('jadwal','jadwal.id','=','antrian.jadwal_id')
                        ->join('pasien','pasien.id','=','antrian.pasien_id')
                        ->join('dokter','dokter.id','=','jadwal.dokter_id')
                        ->join('poli','poli.id','=','dokter.poli_id')
                        ->where('poli.id',$poli->id)
                        ->whereDate('antrian.tanggal_daftar',$besok->toDateString())
                        ->select([
                            'antrian.id',
                            'pasien.nama',
                            'dokter.nama_dokter',
                            'antrian.no_antrian',
                            'antrian.jam_daftar',
                            ])
                        ->get();
        $this->data['poli'] = $poli;
        $this->data['data'] = $data;
        $this->data['besok'] = $besok->format('d/m/Y');
        return view('antrian.besok', $this->data);
    }

    public function laporan()
    {
        return view('antrian.laporan');
    }

    public function laporan_pertanggal()
    {
        return view('antrian.laporan_pertanggal');
    }

    public function download_laporan()
    {
        $today = \Carbon\Carbon::today();
        $data = Poli::all();
        $dataArray = [];
        foreach ($data as $key => $value) {
            $data2 = Antrian::join('jadwal','jadwal.id','=','antrian.jadwal_id')
                    ->join('dokter','dokter.id','=','jadwal.dokter_id')
                    ->join('poli','poli.id','=','dokter.poli_id')
                    ->where('poli.id',$value->id)
                    ->whereDate('antrian.tanggal_daftar',$today)
                    ->select([
                        'antrian.id as jmlAntrian'
                        ])
                    ->count();
            $tmp['nama'] = $value->nama;
            $tmp['kode'] = $value->kode;
            $tmp['jmlAntrian'] = $data2;
            array_push($dataArray,$tmp);
        }
        $dataKirim = ['data' => $dataArray];

        $pdf = PDF::loadView('antrian.pdf', $dataKirim);

        return $pdf->download('laporan.pdf');
    }

    public function download_laporan_pertanggal(Request $request)
    {
        $tglAwal = explode('/',$request->date_awal);
        $tglAkhir = explode('/',$request->date_akhir);
        $tanggalAwal = date($tglAwal[2].'-'.$tglAwal[0].'-'.$tglAwal[1]);
        $tanggalAkhir = date($tglAkhir[2].'-'.$tglAkhir[0].'-'.$tglAkhir[1]);

        $data = Poli::all();
        $dataArray = [];
        foreach ($data as $key => $value) {
            $data2 = Antrian::join('jadwal','jadwal.id','=','antrian.jadwal_id')
                    ->join('dokter','dokter.id','=','jadwal.dokter_id')
                    ->join('poli','poli.id','=','dokter.poli_id')
                    ->where('poli.id',$value->id)
                    ->whereBetween('antrian.tanggal_daftar',[$tanggalAwal, $tanggalAkhir])
                    ->select([
                        'antrian.id as jmlAntrian'
                        ])
                    ->count();
            $tmp['nama'] = $value->nama;
            $tmp['kode'] = $value->kode;
            $tmp['jmlAntrian'] = $data2;
            array_push($dataArray,$tmp);
        }
        $dataKirim = [
            'data' => $dataArray,
            'tglAwal' => $request->date_awal,
            'tglAkhir' => $request->date_akhir
        ];

        $pdf = PDF::loadView('antrian.laporan_pertanggal_pdf', $dataKirim);

        return $pdf->download('laporan.pdf');
    }

    public function antrian_pasien()
    {
        $data = Antrian::join('pasien', 'pasien.id', '=', 'antrian.pasien_id')
                        ->join('jadwal', 'jadwal.id', '=', 'antrian.jadwal_id')
                        ->join('dokter', 'dokter.id', '=', 'jadwal.dokter_id')
                        ->join('poli', 'poli.id', '=', 'dokter.poli_id')
                        ->where('antrian.pasien_id', Auth::user()->pasien->id)
                        ->select([
                            'poli.kode as kodePoli',
                            'poli.nama as namaPoli',
                            'dokter.nama_dokter',
                            'jadwal.hari',
                            'antrian.id',
                            'antrian.no_antrian',
                            'antrian.tanggal_daftar',
                            'antrian.jam_daftar',
                        ])->get();
        $this->data['data'] = $data;

        return view('antrian.pasien', $this->data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $poli = Poli::all();
        $dt = \Carbon\Carbon::now();
        $today = $dt->toDateString();
        $day = $dt->format('l');
        $dayLabel = null;
        if ($day == 'Sunday') {
            $dayLabel = 'Minggu';
        }elseif ($day == 'Monday') {
            $dayLabel = 'Senin';
        }elseif ($day == 'Tuesday') {
            $dayLabel = 'Selasa';
        }elseif ($day == 'Wednesday') {
            $dayLabel = 'Rabu';
        }elseif ($day == 'Thursday') {
            $dayLabel = 'Kamis';
        }elseif ($day == 'Friday') {
            $dayLabel = 'Jumat';
        }elseif ($day == 'Saturday') {
            $dayLabel = 'Sabtu';
        }
        
        foreach ($poli as $key => $value) {
            $data = Poli::join('dokter','poli.id','=','dokter.poli_id')
                    ->join('jadwal','jadwal.dokter_id','=','dokter.id')
                    ->where([
                        'jadwal.hari' => $dayLabel,
                        'poli.id' => $value->id
                        ])
                    ->select([
                        'jadwal.id'
                    ])
                    ->count();
            $value->jadwal = $data;
        }
        
        $this->data['poli'] = $poli;

        return view('antrian.create',$this->data);
    }

    public function tambah_antrian_pasien($id)
    {
        $this->data['jadwal'] = Jadwal::findOrFail($id);
        $this->data['pasiens'] = Pasien::all();
        $this->data['tanggal_daftar'] = $dt = \Carbon\Carbon::now()->format('Y-m-d');

        return view('antrian.add_antrian',$this->data);
    }

    public function tambah_antrian_pasien_save(Request $request)
    {
        $checkAntrian = Antrian::where('pasien_id',$request->pasien_id)->where('jadwal_id',$request->jadwal_id)->whereDate('tanggal_daftar',$request->tanggal_daftar)->first();
        if ($checkAntrian) {
            return back()->with('danger','Pasien sudah terdaftar!');
        }
        $dataAntrian = Antrian::where('jadwal_id',$request->jadwal_id)->whereDate('tanggal_daftar',$request->tanggal_daftar)->count();
        if ($dataAntrian == 40) {
            return back()->with('danger','Maaf pendaftaran sudah penuh!');
        }
        $antrianBaru = new Antrian();
        $antrianBaru->pasien_id = $request->pasien_id;
        $antrianBaru->jadwal_id = $request->jadwal_id;
        $antrianBaru->tanggal_daftar = $request->tanggal_daftar;
        if (!$dataAntrian) {
            $antrianBaru->no_antrian = 1;
            $antrianBaru->jam_daftar = '08:00 - 08:10';
        }else {
            $antrianBaru->no_antrian = (int)$dataAntrian + 1;
            $jamDaftar = (int)$checkAntrian*10;
            $jamDatangAwal = ((int)$dataAntrian-1)*10;
            $jamDatangAkhir = (int)$dataAntrian*10;
            $jam = intdiv($jamDaftar,60);
            $sisa = fmod($jamDaftar,60);
            $jamAntrian = null;
            if ($jam > 0) {
                $sisa = fmod($jamDaftar,60);
                $tmp = 8+$jam;
                $jamAntrian = '0'.$tmp.':'.$sisa;
            }else {
                $sisa = fmod($jamDaftar,60);
                $jamAntrian = '08'.':'.$sisa;
            }
            $tmpJamDaftar = Carbon::now()->format('H:i');
            $harusnya = strtotime($jamAntrian);
            $tapiDaftarnya = strtotime($tmpJamDaftar);
            
            if ($tapiDaftarnya > $harusnya) {
                $tmp = strtotime($tmpJamDaftar);
                $tmp2 = $tmp + 900;
                $tmpJamPulang = date('H:i',$tmp2);
                $jamDatang = $tmpJamDaftar.'-'.$tmpJamPulang; 
            }else {
                $sec = $jamDaftar*60;
                $jamAwal = strtotime('08:00') + ($jamDatangAwal*60);
                $jamAkhir = strtotime('08:00') + ($jamDatangAkhir*60);
                $jamDatang = date('H:i',$jamAwal).'-'.date('H:i',$jamAkhir);
            }
            $antrianBaru->jam_daftar = $jamDatang;
        }
        $antrianBaru->save();

        return back()->with('success', 'Pasien Berhasil ditambahkan!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
