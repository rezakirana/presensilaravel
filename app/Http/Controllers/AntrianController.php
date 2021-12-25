<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Antrian;
use App\Model\Poli;
use App\Model\Dokter;
use App\Model\Pasien;
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
        $today = \Carbon\Carbon::today();
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
                            ->whereDate('antrian.tanggal_daftar',$dt)
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
        //
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
