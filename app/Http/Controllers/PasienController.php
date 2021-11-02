<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Pasien;
use App\User;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['pasiens'] = Pasien::all();
        
        return view('pasien.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('type','pasien')->whereNotIn('id',function($query) {

            $query->select('user_id')->from('pasien');
         
         })->get();
         $this->data['users'] = $users;

         return view('pasien.create',$this->data);
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
            'user_id' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'ttl' => 'required',
            'nik' => 'required|unique:pasien,nik',
        ]);

        $pasien = new Pasien();
        $pasien->user_id = $request->user_id;
        $pasien->nama = $request->nama;
        $pasien->jk = $request->jk;
        $pasien->nik = $request->nik;
        $pasien->alamat = $request->alamat;
        $ttl = explode('/',$request->ttl);
        $pasien->ttl = $ttl[2].'-'.$ttl[1].'-'.$ttl[0];
        $pasien->save();

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan!');
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
        $pasien = Pasien::findOrFail($id);
        $tgl = explode('-',$pasien->ttl);
        $this->data['pasien'] = $pasien;
        $this->data['ttl'] = $tgl[1].'/'.$tgl[2].'/'.$tgl[0];

        return view('pasien.edit',$this->data);
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
        $this->validate($request,[
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'ttl' => 'required',
            'nik' => 'required|unique:pasien,nik,'.$id,
        ]);

        $pasien = Pasien::findOrFail($id);
        $pasien->nama = $request->nama;
        $pasien->jk = $request->jk;
        $pasien->alamat = $request->alamat;
        $pasien->nik = $request->nik;
        $ttl = explode('/',$request->ttl);
        $pasien->ttl = $ttl[2].'-'.$ttl[1].'-'.$ttl[0];
        $pasien->save();

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pasien::where('id', $id)->delete();

        return redirect()->route('pasien.index')->with('success', 'Berhasil menghapus data');
    }
}
