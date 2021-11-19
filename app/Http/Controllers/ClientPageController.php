<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Dokter;
use App\Model\Jadwal;
use App\Model\Poli;
use App\Model\Antrian;
use DB;

class ClientPageController extends Controller
{
    public function pendaftaran()
    {
        $poli = Poli::all();
        foreach ($poli as $key => $value) {
            $data = Antrian::join('jadwal','jadwal.id','=','antrian.jadwal_id')
                    ->join('dokter','dokter.id','=','jadwal.dokter_id')
                    ->join('poli','poli.id','=','dokter.poli_id')
                    ->where('poli.id',$value->id)
                    ->whereDate('antrian.tanggal_daftar',\Carbon\Carbon::today())
                    ->select([
                        'antrian.id as jmlAntrian'
                    ])
                    ->count();
            $value->jmlAntrian = $data;
        }
        dd($value);
        return view('pendaftaran');
    }

    public function profil()
    {
        return view('profil');
    }

    public function motto()
    {
        return view('motto');
    }

    public function visi_misi()
    {
        return view('visi_misi');
    }

    public function jadwal_layanan()
    {
        $poli = Poli::all();
        foreach ($poli as $key => $value) {
            $data = Jadwal::join('dokter','dokter.id','=','jadwal.dokter_id')
            ->where('dokter.poli_id',$value->id)
            ->select([
                'dokter.nama_dokter',
                'jadwal.hari',
                'jadwal.jam_praktik'
            ])->orderByRaw(DB::raw("FIELD(jadwal.hari, 'senin','selasa','rabu','kamis','jumat','sabtu','minggu')"))->get();
            $value->data = $data;
        }
        $this->data['schedules'] = $poli;

        return view('jadwal',$this->data);
    }
}
