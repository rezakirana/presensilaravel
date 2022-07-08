<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        if (session()->get('userLogged') != null) {            
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    }

    public function dashboard()
    {       
        $token = session()->get('tokenUser');
        $response = Http::withToken($token)->get(env("REST_API_ENDPOINT").'/api/info');
        
        $dataResponse = json_decode($response);
        // ini kasih if nanti

        $data = $dataResponse;

        // dd($data);
        return view('admin.dashboard', [
            'jumlah_mapel' => $data->mapel,
            'jumlah_guru' => $data->guru,
            'jumlah_kelas' => $data->kelas,
            'jumlah_siswa' => $data->siswa,
            'jumlah_jadwal' => $data->jadwal,
        ]);
    }

    public function not_found()
    {
        return view('not_found');
    }
}
