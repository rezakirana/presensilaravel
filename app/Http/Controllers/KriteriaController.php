<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kriteria;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();

        return view('kriteria.index')->with('data', $kriteria);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kriteria.create');
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
            'jenis' => 'in:benefit,cost',
            'nama' => 'required'
         ]);

        $data = Kriteria::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis
        ]);
        
        return redirect()->route('kriteria.index')->with('success',
        'Berhasil menambah data');
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
        $kriteria = Kriteria::find($id);

        return view('kriteria.edit')->with('data', $kriteria);
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
            'jenis' => 'in:benefit,cost',
            'nama' => 'required'
         ]);

        $kriteria = Kriteria::find($id);
        $kriteria->nama = $request->nama;
        $kriteria->jenis = $request->jenis;
        $kriteria->save();

        return redirect()->route('kriteria.index')->with('success',
        'Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kriteria::where('id', $id)->delete();

        return redirect()->route('kriteria.index')->with('success',
        'Berhasil menghapus data');
    }
}
