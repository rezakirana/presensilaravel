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
use PDF;

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
        if ($dt == $request->tglAntrian) {
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
                $jamDaftar = $checkAntrian*15;
                $jamDatangAwal = ($checkAntrian-1)*15;
                $jamDatangAkhir = $checkAntrian*15;
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
            }else {
                $antrian->jadwal_id = $scheduleId;
                $antrian->pasien_id = $pasienId;
                $antrian->no_antrian = 1;
                $tmpJamDaftar = Carbon::now()->format('H:i');
                // $jamDaftar = explode(':',$tmpJamDaftar);
                // $tmpMenit = (int)$jamDaftar[1] + 15;
                // if ($tmpMenit >= 60) {
                //     $tmpJam = intdiv($tmpMenit,60);
                //     $tmpMenitSisa = fmod($tmpMenit,60);
                //     if ($tmpMenitSisa == 0) {
                //         $tmpMenitSisa = '00';   
                //     }
                // }else {
                //     $tmpJam = 0;
                //     $tmpMenitSisa = $tmpMenit;
                // }
                // $jamSelesai = (int)$jamDaftar[0] + $tmpJam;
                // if ($jamSelesai < 10) {
                //     $jamSelesai2 = '0'.$jamSelesai;
                // }else {
                //     $jamSelesai2 = $jamSelesai;
                // }
                $tmp = strtotime($tmpJamDaftar);
                $tmp2 = $tmp + 900;
                $tmpJamPulang = date('H:i',$tmp2);
                // $jamDatang = $tmpJamDaftar.'-'.$jamSelesai2.':'.$tmpMenitSisa; 
                $jamDatang = $tmpJamDaftar.'-'.$tmpJamPulang; 
            }
        } else {
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
                $jamDaftar = $checkAntrian*15;
                $jamDatangAwal = ($checkAntrian-1)*15;
                $jamDatangAkhir = $checkAntrian*15;
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
            }else {
                $antrian->jadwal_id = $scheduleId;
                $antrian->pasien_id = $pasienId;
                $antrian->no_antrian = 1;
                $jamDatang = '08:00-08:15';
            }
        }
        $antrian->jam_daftar = $jamDatang;
        $antrian->tanggal_daftar = $request->tglAntrian;
        $antrian->save();
        $data['type'] = 'success';
        $data['message'] = 'Selamat pendaftaran antrian periksa berhasil';
        $data['antrianId'] = route('download.antrian',$antrian->id);

        return json_encode(array('data' => $data));
    }

    public function download_antrian($id)
    {
        $antrian = Antrian::findOrFail($id);
        $hari = date('l',strtotime($antrian->tanggal_daftar));
        $labelHari = null;
        if ($hari == 'Sunday') {
            $labelHari = 'Minggu';
        }elseif ($hari == 'Monday') {
            $labelHari = 'Senin';
        }elseif ($hari == 'Tuesday') {
            $labelHari = 'Selasa';
        }elseif ($hari == 'Wednesday') {
            $labelHari = 'Rabu';
        }elseif ($hari == 'Thursday') {
            $labelHari = 'Kamis';
        }elseif ($hari == 'Friday') {
            $labelHari = 'Jumat';
        }elseif ($hari == 'Saturday') {
            $labelHari = 'Sabtu';
        }
        $lastNotDay = date('d F Y',strtotime($antrian->tanggal_daftar));
        $data['labelHari'] = $labelHari.', '.$lastNotDay;
        $data['noAntrian'] = $antrian->no_antrian;
        $data['jamDatang'] = $antrian->jam_daftar;
        $jadwal = Jadwal::findOrFail($antrian->jadwal_id);
        $data['namaPasien'] = $antrian->pasien->nama;
        $data['nikPasien'] = $antrian->pasien->nik;
        $data['alamatPasien'] = $antrian->pasien->alamat;
        $data['jenisKelaminPasien'] = $antrian->pasien->jk;
        $data['poli'] = $jadwal->dokter->poli->nama;
        $data['kodeAntrian'] = $jadwal->dokter->poli->kode.$antrian->no_antrian;
        $customPaper = array(0,0,380,350);
        $pdf = PDF::loadView('antrian_pdf', $data)->setPaper($customPaper, 'potrait');

        return $pdf->download('antrian.pdf');
    }
}
