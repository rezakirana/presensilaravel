<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TahunAjaran;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['data'] = TahunAjaran::all();

        return view('tahun_ajaran.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahun_ajaran.create');
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
            'tahun_ajaran' => 'required|string'
        ]);

        TahunAjaran::create($request->except('_token'));

        return redirect()->route('tahun-ajaran.index')->with('success', 'Data Tahun Ajaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('tahun_ajaran.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['data'] = TahunAjaran::findOrFail($id);

        return view('tahun_ajaran.edit', $this->data);
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
            'tahun_ajaran' => 'required|string'
        ]);

        TahunAjaran::where('id',$id)->update($request->except(['_token','_method']));

        return redirect()->route('tahun-ajaran.index')->with('success', 'Data Tahun Ajaran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TahunAjaran::where('id', $id)->delete();

        return redirect()->route('tahun-ajaran.index')->with('success', 'Data Tahun Ajaran berhasil dihapus!');
    }
}
