<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Dokter;
use App\Model\Poli;
use App\User;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['dokter'] = Dokter::all();

        return view('dokter.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('type','dokter')->whereNotIn('id',function($query) {
            $query->select('user_id')->from('dokter');
         })->get();
        $this->data['users'] = $users;

        return view('dokter.create',$this->data);
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
            'nama_dokter' => 'required',
            'jk' => 'required',
            'pendidikan_terakhir' => 'required',
            'poli_id' => 'required|integer|exists:poli,id'
        ]);
        $dokter = new Dokter();
        $dokter->user_id = $request->user_id;
        $dokter->nama_dokter = $request->nama_dokter;
        $dokter->jk = $request->jk;
        $dokter->pendidikan_terakhir = $request->pendidikan_terakhir;
        $dokter->poli_id = $request->poli_id;
        $dokter->save();

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan!');
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
        $this->data['dokter'] = Dokter::findOrFail($id);
        $this->data['poli'] = Poli::all();

        return view('dokter.edit',$this->data);
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
            'nama_dokter' => 'required',
            'jk' => 'required',
            'pendidikan_terakhir' => 'required',
            'poli_id' => 'required|integer|exists:poli,id'
        ]);
        $dokter = Dokter::findOrFail($id);
        $dokter->nama_dokter = $request->nama_dokter;
        $dokter->jk = $request->jk;
        $dokter->pendidikan_terakhir = $request->pendidikan_terakhir;
        $dokter->poli_id = $request->poli_id;
        $dokter->save();

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dokter::where('id', $id)->delete();

        return redirect()->route('dokter.index')->with('success', 'Berhasil menghapus data');
    }
}
