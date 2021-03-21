<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kriteria;
use App\Model\SubKriteria;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = Kriteria::where('id', $request->id_kriteria)->first();
        if($data){
            return view('sub_kriteria.create')->with('data', $data);
        }
        return redirect()->route('kriteria.index');
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
            'id_kriteria' => 'required|exists:kriteria,id',
            'nama' => 'required|string',
            'keterangan' => 'required|string',
            'bobot' => 'required|numeric'
         ]);

         $subKriteria = SubKriteria::create([
             'id_kriteria' => $request->id_kriteria,
             'nama' => $request->nama,
             'keterangan' => $request->keterangan,
             'bobot' => $request->bobot
         ]);

         return redirect('/sub-kriteria/'.$request->id_kriteria)->with('success',
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
        $data = Kriteria::with('sub_kriteria')->where('id',$id)->first();
        
        return view('sub_kriteria.index')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subKriteria = SubKriteria::find($id);
        if ($subKriteria) {
            return view('sub_kriteria.edit')->with('data', $subKriteria);
        }
        return redirect('/sub-kriteria/'.$request->id_kriteria);
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
            'nama' => 'required|string',
            'keterangan' => 'required|string',
            'bobot' => 'required|numeric'
        ]);
        
        $subKriteria = SubKriteria::find($id);
        $subKriteria->nama = $request->nama;
        $subKriteria->keterangan = $request->keterangan;
        $subKriteria->bobot = $request->bobot;
        $subKriteria->save();
        
        return redirect('/sub-kriteria/'.$request->id_kriteria)->with('success',
        'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $root = SubKriteria::where('id', $id);
        $id_kriteria = $root->first()->id_kriteria;
        $root->delete();

        return redirect('/sub-kriteria/'.$id_kriteria)->with('success',
        'Berhasil menghapus data');
    }
}
