<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Mapel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['mapel'] = Mapel::all();

        return view('mapel.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapel.create');
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
            'kode_mapel' => 'required|unique:mapel,kode_mapel',
            'nama_mapel' => 'required|string'
        ]);

        Mapel::create($request->except('_token'));

        return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('mapel.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['mapel'] = Mapel::findOrFail($id);

        return view('mapel.edit', $this->data);
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
            'kode_mapel' => 'required|unique:mapel,kode_mapel,'.$id,
            'nama_mapel' => 'required|string'
        ]);

        Mapel::where('id',$id)->update($request->except(['_token','_method']));

        return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mapel::where('id', $id)->delete();

        return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil dihapus!');
    }
}
