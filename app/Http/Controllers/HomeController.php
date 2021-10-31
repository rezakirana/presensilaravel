<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\Gejala;
use App\Model\Penyakit;
use App\Model\Konsultasi;

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
        // if (Auth::user()->role->role != 'user') {
        //     $this->data['gejala'] = Gejala::count();
        //     $this->data['penyakit'] = Penyakit::count();
        //     $this->data['konsultasi'] = Konsultasi::count();
        // }else {
        //     $this->data['gejala'] = Gejala::count();
        //     $this->data['penyakit'] = Penyakit::count();
        //     $this->data['konsultasi'] = Konsultasi::where('user_id', Auth::id())->count();
        // }
        
        return view('admin.dashboard');
    }

    public function not_found()
    {
        return view('not_found');
    }
}
