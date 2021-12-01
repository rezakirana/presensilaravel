<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Dokter;
use App\Model\Jadwal;
use App\Model\Poli;
use App\Model\Antrian;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

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
        $this->data['poli'] = $poli;

        return view('pendaftaran',$this->data);
    }

    public function pendaftaran_detail($id)
    {
        if (!Auth::check()) {
            $url = '/pendaftaran/'.$id;
            session()->put('lastUrl',$url);
            
            return redirect()->route('login');
        }
        $poli = Poli::findOrFail($id);
        $NewDate=Date('Y-m-d', strtotime('+30 days'));
        $dt = Carbon::now();
        $periods = CarbonPeriod::create($dt->toDateString(), $NewDate);
        $arr = [];
        foreach($periods as $nil)
        {
            $tmp['completeDate'] = $nil->format('Y-m-d');
            $tmp['day'] = $nil->format('d');
            if ($nil->format('l') == 'Sunday') {
                $hari = 'Minggu';
            }elseif ($nil->format('l') == 'Monday') {
                $hari = 'Senin';
            }elseif ($nil->format('l') == 'Tuesday') {
                $hari = 'Selasa';
            }elseif ($nil->format('l') == 'Wednesday') {
                $hari = 'Rabu';
            }elseif ($nil->format('l') == 'Thursday') {
                $hari = 'Kamis';
            }elseif ($nil->format('l') == 'Friday') {
                $hari = 'Jumat';
            }elseif ($nil->format('l') == 'Saturday') {
                $hari = 'Sabtu';
            }
            $tmp['labelDay'] = $hari;
            $tmp['month'] = $nil->format('F');
            $tmp['year'] = $nil->format('Y');
            array_push($arr,$tmp);
        }
        $this->data['poli'] = $poli;
        $this->data['backdate'] = $arr;

        return view('pendaftaran_detail',$this->data);
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

    public function ambil_jadwal(Request $request)
    {
        $hari = strtolower($request->labelHari);
        $dt = Carbon::now()->format('Y-m-d');
        // $checkAntrian = Antrian::join('pasien','pasien.id','=','antrian.pasien_id')
        //                         ->join('jadwal','jadwal.id','=','antrian.pasien_id')
        //                         ->join('dokter','dokter.id','=','jadwal.dokter_id')
        //                         ->join('poli','poli.id','=','dokter.poli_id')
        //                         ->where('antrian.pasien_id','!=',Auth::user()->pasien->id)
        //                         ->where('antrian.tanggal_daftar',$request->tglAntrian)
        //                         ->where('poli.')
        // $poli = Poli::findOrFail($request->poliId);
        $dokters = Dokter::where('poli_id',$request->poliId)->get();
        $scheduleId = null;
        foreach ($dokters as $key => $value) {
            $schedule = Jadwal::where([
                                    'dokter_id' => $value->id,
                                    'hari' => $hari
                                ])->first();

            if ($schedule) {
                $scheduleId = $schedule->id;
            }
        }        
        if (!$scheduleId) {
            $data['type'] = 'warning';
            $data['message'] = 'maaf, tidak ada jadwal praktik pada hari '.$request->labelHari.', '.$request->hariAngka.' '.$request->bulan.' '.$request->tahun;
            
            return json_encode(array('data' => $data));
        }
        $pasienId = Auth::user()->pasien->id;
        $checkAntrian = Antrian::where([
                                    'tanggal_daftar' => $request->tglAntrian,
                                    'jadwal_id' => $scheduleId
                                ])->count();
        $antrian = new Antrian();
        if ($checkAntrian) {
            $checkAntrian2 = Antrian::where([
                                            'tanggal_daftar' => $request->tglAntrian,
                                            'jadwal_id' => $scheduleId,
                                            'pasien_id' => $pasienId
                                        ])->count();
            if ($checkAntrian2) {
                $data['type'] = 'warning';
                $data['message'] = 'maaf, anda sudah terdaftar periksa pada hari '.$request->labelHari.', '.$request->hariAngka.' '.$request->bulan.' '.$request->tahun;

                return json_encode(array('data' => $data));
            }
            $antrian->jadwal_id = $scheduleId;
            $antrian->pasien_id = $pasienId;
            $antrian->no_antrian = ($checkAntrian + 1);
            $jamDaftar = ($checkAntrian+1)*15;
            $jam = intdiv($jamDaftar,60);
            $sisa = fmod($jamDaftar,60);
            $jamAntrian = null;
            if ($jam > 0) {
                $sisa = fmod($jamDaftar,60);
                $tmp = 8+$jam;
                $jamAntrian = '0'.$tmp.'.'.$sisa;
            }else {
                $sisa = fmod($jamDaftar,60);
                $jamAntrian = '08'.'.'.$sisa;
            }
            $antrian->tanggal_daftar = $request->tglAntrian;
            $antrian->jam_daftar = $jamAntrian;
        }else {
            $antrian->jadwal_id = $scheduleId;
            $antrian->pasien_id = $pasienId;
            $antrian->no_antrian = 1;
            $antrian->tanggal_daftar = $request->tglAntrian;
            $antrian->jam_daftar = '08.15';
        }
        $antrian->save();
        $data['type'] = 'success';
        $data['message'] = 'Selamat pendaftaran antrian periksa berhasil';
        $data['antrianId'] = route('download.antrian',$antrian->id);

        return json_encode(array('data' => $data));
    }

    public function download_antrian($id)
    {
        $antrian = Antrian::findOrFail($id);
        dd($antrian);
    }
}
