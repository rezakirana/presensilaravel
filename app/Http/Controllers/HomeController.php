<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */    

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
        if (Auth::user()->type == 'admin') {
            $this->data['jmlGuru'] = Account::count();
            $this->data['jmlKelas'] = Kelas::count();
            $this->data['jmlSiswa'] = Siswa::count();
            $this->data['jmlMapel'] = Mapel::count();
            $this->data['jmlJadwal'] = Jadwal::where('is_active',1)->count();
        }else {
            $this->data['jmlKelas'] = Jadwal::where('guru_id',Auth::user()->guru->id)->count();
            $this->data['jmlJadwal'] = Jadwal::where('guru_id',Auth::user()->guru->id)
                                                ->where('is_active',1)
                                                ->count();                
        }
        return view('admin.dashboard',$this->data);
    }

    public function not_found()
    {
        return view('not_found');
    }
}
