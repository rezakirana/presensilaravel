<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Antrian;
use App\Model\Poli;
use App\Model\Dokter;
use App\Model\Pasien;
use DB;use Illuminate\Support\Facades\Auth;

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
                $data = Antrian::join('jadwal','jadwal.id','=','antrian.jadwal_id')
                        ->join('dokter','dokter.id','=','jadwal.dokter_id')
                        ->join('poli','poli.id','=','dokter.poli_id')
                        ->where('poli.id',$value->id)
                        ->whereDate('antrian.tanggal_daftar',$today)
                        ->select([
                            'antrian.id as jmlAntrian'
                            ])
                        ->count();
                $value->jmlAntrian = $data;
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
                    $data = Antrian::join('jadwal','jadwal.id','=','antrian.jadwal_id')
                            ->join('dokter','dokter.id','=','jadwal.dokter_id')
                            ->join('poli','poli.id','=','dokter.poli_id')
                            ->where('poli.id',$value->id)
                            ->whereDate('antrian.tanggal_daftar',$dt)
                            ->select([
                                'antrian.id as jmlAntrian'
                                ])
                            ->count();
                    $value->jmlAntrian = $data;
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
