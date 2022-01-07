<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\Pasien;
use App\Model\Dokter;
use App\Model\Poli;
use App\Model\Antrian;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */    
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $poli = Poli::count();        
        if ($user->type == 'admin') {
            $pasien = Pasien::count();
            $dokter = Dokter::count();
            $this->data['dokter'] = $dokter;
            $this->data['pasien'] = $pasien;
        }elseif ($user->type == 'dokter') {
            $pasien = Antrian::join('jadwal','jadwal.id','=','antrian.jadwal_id')                        
                                ->join('pasien','pasien.id','=','antrian.pasien_id')
                                ->join('dokter','dokter.id','=','jadwal.dokter_id')
                                ->where('dokter.id',$user->dokter->id)
                                ->select([
                                    'pasien.id',
                                    'pasien.nama',
                                    'pasien.alamat',
                                    'pasien.nik',
                                    'pasien.jk',
                                    'pasien.ttl',
                                ])->groupBy('antrian.pasien_id')
                                ->get();
            $this->data['pasien'] = count($pasien);
        }else {
            $dokter = Dokter::count();
            $pasien = Pasien::count();
            $this->data['dokter'] = $dokter;
            $this->data['pasien'] = $pasien;
        }
        $this->data['poli'] = $poli;
        $this->data['user'] = $user;

        return view('admin.dashboard',$this->data);
    }

    public function not_found()
    {
        return view('not_found');
    }
}
