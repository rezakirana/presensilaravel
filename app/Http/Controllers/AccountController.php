<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\Pasien;
use App\Model\Dokter;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 'pasien') {
            $tgl = Auth::user()->pasien->ttl;
            $tgl = explode('-',$tgl);
            $this->data['ttl'] = $tgl[1].'/'.$tgl[2].'/'.$tgl[0];

            return view('account.index', $this->data);
        }
        return view('account.index');
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
        $this->validate($request,[
            'currentPassword' => 'required|string',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = Auth::user();
        $cekPassword = Hash::check($request->currentPassword, $user->password);
        if (!$cekPassword) {
            return redirect()->route('account.index')->with('danger','Current password does not match!');
        }
        
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('account.index')->with('success', 'Your password changed successfully!');
    }

    public function account_profile(Request $request)
    {
        if (Auth::user()->type == 'dokter') {
            $dokter = Dokter::where('user_id',Auth::id())->first();
            $dokter->nama_dokter = $request->nama_dokter;
            $dokter->jk = $request->jk;
            $dokter->pendidikan_terakhir = $request->pendidikan_terakhir;
            $dokter->save();
        } else {
            $pasien = Pasien::where('user_id',Auth::id())->first();
            $pasien->nama = $request->nama;
            $pasien->jk = $request->jk;
            $pasien->nik = $request->nik;
            $pasien->alamat = $request->alamat;
            $ttl = explode('/',$request->ttl);
            $pasien->ttl = $ttl[2].'-'.$ttl[1].'-'.$ttl[0];
            $pasien->save();
        }
        return redirect()->route('account.index')->with('success', 'Your profile changed successfully!');
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
